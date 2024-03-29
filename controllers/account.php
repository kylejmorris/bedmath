<?php

/**
 * The account component offers personalized functionality for a registered user. 
 * Navigation to a variety of management pages is available, along with other ways to customize the environment.
 */
Class Account extends Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user->isLoggedIn()) {
            $_SESSION['returnPage'] = $_GET['url'];
            header('Location: ' . ROOT . 'login', TRUE, 302);
        }
    }

    /**
     * Displays main navigation to more specific account pages. 
     */
    public function index($test) {
        $this->view->render("account/index", array('mathjax', 'ckeditor'));
    }
    
    public function changedPass() {
        $this->view->render('account/changedpass', array('mathjax', 'ckeditor'));
    }

    /**
     * Displays points analysis for user account. 
     * Logging when points were earned, and what reason. Also giving statistics on overall points standings such as "total earned", "cashed out", "etc". 
     * @param $since The earliest time to get transactions from. 
     * 		 Will be set as string value such as'day', 'week' etc. 
     * @param $type The type of transaction to display. 
     * Example: The value 1 may associate with the rule "Donated" in the g0g1_points type_id column
     */
    public function points($since, $type) {
        $userId = $this->user->getUserId();
        $pointStats = $this->model->getPointStats($userId, $since); //Getting array containing points statistics
        $pointsHistory = $this->model->getTransactions($userId, $since, $type);
        $this->view->since = $since; //Sending value to view in order to determine proper sorting
        $this->view->types = $this->points->getTransactionTypes();
        $this->view->pointStats = $pointStats;
        $this->view->pointsHistory = $pointsHistory;
        $this->view->render("account/points", array('mathjax', 'ckeditor'));
    }

    public function profile() {
        $userId = $this->user->getUserId();
        $details = $this->user->getDetailFromId($userId);
        $image = new Image($this->database);
        $avatars = $image->getImagesByType(3);
        $this->view->avatars = $avatars;
        $this->view->details = $details;

        $this->view->render('account/profile', array('mathjax', 'ckeditor'));
    }

    public function runProfile() {
        $userId = $this->user->getUserId();
        $form = array(
            'email' => '',
            'avatar' => '',
        );

        $formData = $this->form->getFormContent($form);
        if (empty($formData['avatar'])) {
            $detail = $this->user->getDetailFromId($userId);
            $formData['avatar'] = $detail['avatar_id'];
        }
        $this->model->runProfile($userId, $formData);
        header('Location:' . ROOT . 'account/');
    }

    public function newPass() {
        $this->view->render('account/newpass', array('mathjax', 'ckeditor'));
    }

    public function runNewPass() {
        $form = array('old' => '', 'new' => '', 'again' => '');
        $formData = array(//The form element names to get data from 
            'old' => array(
                'required' => true,
                'min_length' => 6,
                'max_length' => 64,
            ),
            'new' => array(
                'required' => true,
                'min_length' => 6,
                'max_length' => 64,
            ),
            'again' => array(
                'required' => true,
                'min_length' => 6,
                'max_length' => 64,
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            if ($formData['new'] != $formData['again']) {
                $GLOBALS['error']->addError('user', 'Make sure new passwords match');
            }
        }
        if (!$this->pass->isValid($this->user->getUserId(), $formData['old'])) {
            $GLOBALS['error']->addError('user', 'Old password entered is not correct');
        }
        if ($GLOBALS['error']->getErrorCount() == 0) {
            $this->model->runNewPass($this->user->getUserId(), $formData['new']);
            header('Location: '.ROOT.'account/changedpass');
        }
    }

    public function questions($page) {
        if ($page == null) {
            $page = 1;
        }
        $limit = 10;
        $userId = $this->user->getUserId();
        $this->view->questions = $this->model->questions($page, $userId, $limit);
        $qCount = $this->question->getQuestionCount(array('asked_by' => $userId)); // Returns number of questions in which can be displayed on page.
        $this->view->pagination = $this->pagination->getPageList($page, 10, $qCount);
        $this->view->render('account/questions', array('ckeditor'));
    }

    /**
     * Allow user to edit question they have posted.
     * @param $id the question id being edited.
     */
    public function editQuestion($qid) {
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if (!$this->question->isOwner($qid, $this->user->getUserId())) {
            $GLOBALS['error']->addError('question', 'You did not post this question');
        }
        if ($GLOBALS['error']->getErrorCount('question') > 0) {
            $this->view->render('error/error');
        } else {
            $this->view->qid = $qid;
            $this->view->topics = $this->category->getCategories();
            var_dump($this->view->topics);
            $this->view->question = $this->question->getDetailById($qid);
            $this->view->render('account/edit_question');
        }
    }

    public function runEditQuestion($qid) {
        $formData = array(
            'title' => array(
                'required' => true,
                'min_length' => 3,
                'max_length' => 64
            ),
            'topic' => array(
                'required' => true
            ),
            'full' => array(
                'min_length' => 1,
                'max_length' => 1024
            ),
            'bid' => array(
                'required' => true,
                'is_numeric' => true,
                'min_value' => 10
            ),
            'published' => array(
                'required' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runEditQuestion($qid, $formData);
            $this->view->render('account/edit_question_success');
        } else {
            $this->view->render('error/error', array('ckeditor'));
        }
    }

    public function answers($page) {
        if ($page == null) {
            $page = 1;
        }
        $limit = 10;
        $userId = $this->user->getUserId();
        $this->view->answers = $this->model->answers($page, $userId, $limit);
        $aCount = $this->answer->getAnswerCount(array('user' => $userId)); //Getting number of answers user has posted.
        $this->view->pagination = $this->pagination->getPageList($page, $limit, $aCount);
        $this->view->render('account/answers', array('ckeditor'));
    }

    /**
     * Allow user to edit answer they have posted
     * @param $id the answer id being edited.
     */
    public function editAnswer($id) {
        if (!$this->answer->exists($id)) {
            $GLOBALS['error']->addError('answer', 'Answer does not exist');
        }
        if (!$this->answer->isOwner($id, $this->user->getUserId())) {
            $GLOBALS['error']->addError('answer', 'You did not post this answer');
        }
        if ($GLOBALS['error']->getErrorCount('answer') > 0) {
            $this->view->render('error/error');
        } else {
            $this->view->id = $id;
            $this->view->answer = $this->answer->getAnswerById($id);
            $this->view->render('account/edit_answer');
        }
    }

    public function runEditAnswer($id) {
        $formData = array(
            'full_text' => array(
                'required' => true,
                'min_length' => 100,
                'max_length' => 5012
            ),
            'published' => array(
                'required' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runEditAnswer($id, $formData);
            $this->view->render('account/edit_answer_success', array('ckeditor'));
        } else {
            $this->view->render('error/error', array('ckeditor'));
        }
    }
    
    public function notifications($viewed, $type) {
        $userId = $this->user->getUserId();
        $this->view->history = $this->notification->getNotifications($type, null, $userId, $viewed, $page, 25);
        $this->notification->addNotification('question_posted', $userId, null, 14);
        $this->view->render('account/notifications', array('ckeditor'));
    }

}

?>