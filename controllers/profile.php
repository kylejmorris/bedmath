<?php

class Profile extends Controller {

    public $userId;
    public $answerHistLimit = 10; //Max amount of answers to show per page for answer history.
    public $questionHistLimit = 10; //Max amount of answers to show per page for question history.
    public $repHistLimit = 10;//Max amount of records to show per page for reputation history.
    public $inviteHistLimit = 10; //Max amount of users to show per page for invite history.

    public function __construct() {
        parent::__construct();
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
    public function user($userId, $tab, $histPage, $histTopic) {
        $this->userId = $userId;
        if (!empty($this->userId)) { //Check if id was supplied in url
            $this->user->exists($this->userId);
            if ($tab != null) {
                switch ($tab) {
                    case "questions": $this->questions($histPage, $histTopic);
                        break;
                    case "answers": $this->answers($histPage, $histTopic);
                        break;
                    case "reputation": $this->reputation($histPage);
                        break;
                    case "invites": $this->invites($histPage);
                        break;
                    default: $this->user($this->userId); //re-run method just loading general user summary information
                }
            } else {
                $userDetail = $this->model->getUserSummary($this->userId); //Run model getting user details
                $this->view->userId = $this->userId;
                $this->view->userDetail = $userDetail; //Send to template
                $this->view->avatarWidth = 100; //Width of profile image
                $this->view->avatarHeight = 150; //height of Profile image
                if ($GLOBALS['error']->getErrorCount('user') == 0) {
                    $this->view->render('profile/user', array('ckeditor'));
                } else {
                    $this->view->render('error/index', array('ckeditor'));
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
        $this->view->userId = $this->userId;
        $this->view->pagination = $this->pagination->getPageList($page, 10, $count);
        $this->view->topic = $topic;
        $this->view->questionSummary = $this->model->getQuestionSummary($this->userId);
        $this->view->questionHistory = $this->model->getQuestionHistory($this->userId, $topic, $page);
        if ($GLOBALS['error']->getErrorCount('user') == 0) {
            if ($count > 0) {
                $this->view->render('profile/user_questions', array('ckeditor'));
            } else {
                $this->view->render('profile/user_questions_empty', array('ckeditor'));
            }
        } else {
            $this->view->render('error/index');
        }
    }

    private function answers($page) {
        if ($page == null) {
            $page = 1;
        }
        $this->view->userId = $this->userId;
        $count = $this->answer->getAnswerCount(array('user' => $this->userId));
        $this->view->pagination = $this->pagination->getPageList($page, $this->answerHistLimit, $count);
        $this->view->answerSummary = $this->model->getAnswerSummary($this->userId);
        $this->view->answerHistory = $this->model->getAnswerHistory($this->userId, $page, $this->answerHistLimit);
        if ($GLOBALS['error']->getErrorCount('user') == 0) {
            if ($count > 0) {
                $this->view->render('profile/user_answers', array('ckeditor'));
            } else {
                $this->view->render('profile/user_answers_empty', array('ckeditor'));
            }
        } else {
            $this->view->render('error/index', array('ckeditor'));
        }
    }

    private function reputation($page) {
        if ($page == null) {
            $page = 1;
        }
        $this->view->reputationHistory = $this->model->getReputationHistory($this->userId, $page, $this->repHistLimit);
        $count = $this->reputation->getLogCount($this->userId);
        $this->view->pagination = $this->pagination->getPageList($page, $this->repHistLimit, $count);
        $this->view->userId = $this->userId;
        $this->view->reputationSummary = $this->model->getReputationSummary($this->userId, $page);
        if ($GLOBALS['error']->getErrorCount('user') == 0) {
            if ($count > 0) {
                $this->view->render('profile/user_reputation', array('ckeditor'));
            } else {
                $this->view->render('profile/user_reputation_empty', array('ckeditor'));
            }
        } else {
            $this->view->render('error/index');
        }
    }
    
    private function invites($page) {
        if ($page == null) {
            $page = 1;
        }
        $this->view->userId = $this->userId;
        $count = $this->invite->getInviteCount($userId);
        $this->view->pagination = $this->pagination->getPageList($page, $this->inviteHistLimit, $count);
        $this->view->inviteSummary = $this->model->getInviteSummary($this->userId);
        $this->view->inviteHistory = $this->model->getInviteHistory($this->userId, null, $page, $this->inviteHistLimit);
        if ($GLOBALS['error']->getErrorCount('user') == 0) {
            if ($count > 0) {
                $this->view->render('profile/user_invites', array('ckeditor'));
            } else {
                $this->view->render('profile/user_invites_empty', array('ckeditor'));
            }
        } else {
            $this->view->render('error/index', array('ckeditor'));
        }
        
    }

}

?>