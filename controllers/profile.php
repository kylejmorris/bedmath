<?php

class Profile extends Controller {

    public $userId;

    public function __construct() {
        parent::__construct();
        $this->writing = new Writing();
        $this->pagination = new Pagination();
        $this->question = new Question();
        $this->user = new User();
    }

    //Nothing here really...
    public function index() {
        
    }

    /**
     * Viewing of users profile page containing specified data about themselves and their stance on the site.
     * @param $userId The id of user in which to get information on. 
     * @param $tab the tab being loaded for profile, such as reputation page, questions, etc.
     * @param $histTopic the topic to view for history page
     * @param $histOrder the order to view history results on log/history pages. 
     * @param $histPage for sorting of history pages, such as questions, reputation. Defines how many results load on each page.
     */
    public function user($userId, $tab, $histTopic, $histOrder, $histPage) {
        $this->userId = $userId;
        if (!empty($this->userId)) { //Check if id was supplied in url
            $this->user->exists($this->userId);
            if ($tab != null) {
                switch ($tab) {
                    case "questions": $this->questions($histTopic, $histOrder, $histPage);
                        break;
                    case "answers": $this->answers();
                        break;
                    case "reputation": $this->reputation();
                        break;
                    default: $this->user($this->userId);
                }
            } else {
                $userDetail = $this->model->getUserSummary($this->userId); //Run model getting user details
                $this->view->userId = $this->userId;
                $this->view->userDetail = $userDetail; //Send to template
                $this->view->avatarWidth = 100; //Width of profile image
                $this->view->avatarHeight = 150; //height of Profile image
                if ($GLOBALS['error']->getErrorCount('user') == 0) {
                    $this->view->render('profile/user');
                } else {
                    $this->view->render('error/index');
                }
            }
        } else {
            header("Location:" . ROOT . 'members');
        }
    }

    private function questions($page, $topic) {
        if ($page == null) {
            $page = 1;
        }
        if ($topic == 0) {
            $topic = null;
        }
        $count = $this->question->getQuestionCount(array('asked_by' => $this->userId));
        $this->view->pagination = $this->pagination->getPageList($page, 10, $count);
        $this->view->userId = $this->userId;
        $this->view->topic = $topic;
        $this->view->questionSummary = $this->model->getQuestionSummary($this->userId);
        $this->view->questionHistory = $this->model->getQuestionHistory($this->userId, $topic, $page);
        if ($GLOBALS['error']->getErrorCount('user') == 0) {
            $this->view->render('profile/user_questions');
        } else {
            $this->view->render('error/index');
        }
    }

    private function answers() {
        $this->view->userId = $this->userId;
        $this->view->answerSummary = $this->model->getAnswerSummary($this->userId);
        $this->view->answerHistory = $this->model->getAnswerHistory($this->userId);
        $this->view->render('profile/user_answers');
    }
    
    private function reputation() {
        
    }
}
?>