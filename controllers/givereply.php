<?php

class GiveReply extends Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user->isLoggedIn()) {
            $_SESSION['returnPage'] = $_GET['url'];
            header('Location: ' . ROOT . 'login', TRUE, 302);
        }
    }

    public function index() {
        $this->question(-1, -1); //No valid data has been supplied, so ensure an error is shown
    }

    /**
     * Allow creation of answer by tutor, in response to selected question.
     * @param $id the question being answered.
     */
    public function question($qid, $answerId) {
        $this->view->qid = $qid; //passing question id to view for resubmission.
        $this->view->answerId = $answerId; //Passing answer id to view for resubmission.
        if (!$this->question->isOwner($qid, $this->user->getUserId()) && !$this->answer->isOwner($answerId, $this->user->getUserId())) {
            $GLOBALS['error']->addError('user', 'You do not own either the answer or question involved here.');
        }
        if (!$this->user->isLoggedIn()) {
            $GLOBALS['error']->addError('user', 'You are not logged in');
        }
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if (!$this->answer->existsWithinQuestion($answerId, $qid)) {
            $GLOBALS['error']->addError('answer', 'Answer does not exist');
        }
        if ($GLOBALS['error']->getErrorCount() > 0) {
            $this->view->render('error/error');
            return false;
        }
        $this->view->render('givereply/question');
    }

    public function questionRun($qid, $answerId) {
        if (!$this->question->isOwner($qid, $this->user->getUserId()) && !$this->answer->isOwner($answerId, $this->user->getUserId())) {
            $GLOBALS['error']->addError('user', 'You do not own either the answer or question involved here.');
        }
        if (!$this->user->isLoggedIn()) {
            $GLOBALS['error']->addError('user', 'You are not logged in');
        }
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if (!$this->answer->existsWithinQuestion($answerId, $qid)) {
            $GLOBALS['error']->addError('answer', 'Answer does not exist');
        }
        $formData = array(
            'full_text' => array(
                'required' => true,
                'max_length' => 5012
            )
        );
        if ($GLOBALS['error']->getErrorCount() == 0) {
            $form = new Form($formData);
            if ($form->isValid()) {
                $formData = $form->getFormData();
                $userId = $this->user->getUserId();
                $this->model->runQuestion($userId, $qid, $answerId, $formData);
                header("Location: " . ROOT . 'review/question/' . $qid);
            }
        } else {
            $this->view->render('error/error');
        }
    }

    /**
     * Separate function sharing nearly same code as normal reply page. 
     * However quick reply requires sanatizing of string, since it's not using an editor to do it. 
     * @param type $qid question id
     * @param type $answerId the answer id
     */
    public function questionQuickReply($qid, $answerId) {
        if (!$this->question->isOwner($qid, $this->user->getUserId()) && !$this->answer->isOwner($answerId, $this->user->getUserId())) {
            $GLOBALS['error']->addError('user', 'You do not own either the answer or question involved here.');
        }
        if (!$this->user->isLoggedIn()) {
            $GLOBALS['error']->addError('user', 'You are not logged in');
        }
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if (!$this->answer->existsWithinQuestion($answerId, $qid)) {
            $GLOBALS['error']->addError('answer', 'Answer does not exist');
        }
        $formData = array(
            'full_text' => array(
                'required' => true,
                'max_length' => 5012
            )
        );
        if ($GLOBALS['error']->getErrorCount() == 0) {
            $form = new Form($formData);
            if ($form->isValid()) {
                $formData = $form->getFormData();
                $formData['full_text'] = strip_tags($formData['full_text'], '<b><i><u>');
                $userId = $this->user->getUserId();
                $this->model->runQuestion($userId, $qid, $answerId, $formData);
                header("Location: " . ROOT . 'review/question/' . $qid);
            }
        } else {
            $this->view->render('error/error');
        }
    }

}

?>