<?php

class Mod_Answers extends Controller {

    public function __construct() {
        parent::__construct();
        $this->question = new Question();
        $this->user = new User();
        $this->answer = new Answer();
        $this->pagination = new Pagination();
        $this->form = new Form();
        $this->category = new Category();
    }

    public function index() {
        $this->view->summary = $this->model->getSummary();
        $this->view->render('mod_answers/index');
    }

    /**
     * Loads question history
     */
    public function history($page, $user) {
        $this->view->user = $user; //Passing user value to show in form as current user value.
        if ($page == null) {
            $page = 1;
        }
        if ($user == 'anyuser') {
            $user = null;
        }
        $userId = $this->user->nameToId($user);
        if ($user != null && !$this->user->exists($userId)) {
            $GLOBALS['error']->addError('user', 'That user does not exist');
        } else {
            $user = $this->user->nameToId($user);
            $this->view->pagination = $this->pagination->getPageList($page, 25, $this->question->getQuestionCount(array('user' => $user)));
            $this->view->answers = $this->model->getHistory($page, $user);
        }

        $this->view->render('mod_answers/history');
    }

    /**
     * Allow detailed summary of individual question and it's corresponding answers.
     * @param type $qid
     * @param type $version
     */
    public function review($id, $version) {
        if ($id != null) {
            if(!$this->answer->exists($id)) {
                $GLOBALS['error']->addError('answer', 'Invalid answer id');
            } else {
                $this->view->answerSummary = $this->model->getAnswerReviewSummary($id, $version);
                $this->view->replies = $this->model->getReviewReplies($id);
            }
        } else {
            $GLOBALS['error']->addError('answer', 'Please supply an answer id.');
        }
        $this->view->render('mod_answers/review');
    }
    
    /**
     * Allow staff member editing rights to a question posted.
     */
    public function edit($qid) {
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if ($GLOBALS['error']->getErrorCount('question') > 0) {
            $this->view->render('error/error');
        } else {
            $this->view->qid = $qid;
            $this->view->topics = $this->category->getCategories();
            $this->view->question = $this->question->getDetailById($qid);
            $this->view->render('mod_questions/edit');
        }
    }
    
    public function runEdit($qid) {
        $formData = array(
            'title' => array(
                'require' => true,
                'min_length' => 3,
                'max_length' => 64
            ),
            'topic' => array(
                'required' => true
            ),
            'full' => array(
                'min_length' => 1,
                'max_length' => 5012
            ),
            'bid' => array(
                'required' => true
            ),
            'published' => array(
                'required' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runEditQuestion($qid, $formData);
            $this->view->render('mod_questions/edit_success');
        } else {
            $this->view->render('error/error');
        }
    }

}

?>