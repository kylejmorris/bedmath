<?php

/**
 * The account component offers personalized functionality for a registered user. 
 * Navigation to a variety of management pages is available, along with other ways to customize the environment.
 */
Class Account extends Controller {

    public function __construct() {
        parent::__construct();
        $this->points = new Points();
        $this->writing = new Writing();
        $this->form = new Form();
        $this->user = new User();
        $this->image = new Image();
        $this->question = new Question();
        $this->pagination = new Pagination();
        if (!$this->user->isLoggedIn()) {
            header('location: ' . ROOT);
        }
    }

    /**
     * Displays main navigation to more specific account pages. 
     */
    public function index($test) {
        $this->view->render("account/index");
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
        $this->view->render("account/points");
    }

    /**
     * Displays writing management pages
     * Shows stats on writing and enables navigation to further editing of current site content
     * @param $action The action in which to make on content. such as 'edit'
     * @param $id The content id in which to envoke action on
     */
    public function writing($action, $id) {
        if ($action == 'edit') {
            $writing = $this->writing->getDetailBy('content_id', $id);
            $this->view->writing = $writing;
            $this->view->render("account/writingedit");
        } else {
            $userId = $this->user->getUserId();
            $writingStats = $this->model->getWritingStats($userId);
            $details = $this->model->getWritingDetails($userId); //Getting summary of writing within array, returning details to display. 
            $this->view->writingStats = $writingStats;
            $this->view->detail = $details;
            $this->view->render("account/writing");
        }
    }

    public function runWritingEdit($id) {
        $form = array(
            "title" => '',
            "description" => '',
        );

        $formData = $this->form->getFormContent($form);
        $this->model->runWritingEdit($id, $formData);
    }

    public function profile() {
        $userId = $this->user->getUserId();
        $details = $this->user->getDetailFromId($userId);
        $avatars = $this->image->getImagesByType(3);
        $this->view->avatars = $avatars;
        $this->view->details = $details;

        $this->view->render('account/profile');
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
        $this->view->render('account/newpass');
    }

    public function runNewPass() {
        $form = array('old' => '', 'new' => '', 'again' => '');
        $formData = $this->form->getFormContent($form);
        $userId = $this->user->getUserId();
        $userData = $this->user->getDetailFromId($userId);
        if ($formData['old'] == $userData['password']) {
            if ($formData['new'] == $formData['again']) {
                $this->user->setNewPass($userId, $formData['new']);
                $this->view->render('account/newpasssuccess');
            } else {
                echo 'Please enter the new password twice';
            }
        } else {
            echo 'That is not the old password';
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
        $this->view->render('account/questions');
    }

}

?>