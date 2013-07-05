<?php

class Review extends Controller {

    public function __construct() {
        parent::__construct();
        $this->question = new Question();
        $this->user = new User();
        $this->reply = new Reply();
        $this->answer = new Answer();
    }

    /**
     *
     */
    public function question($id) {
        $this->view->question = $this->model->question($id);
        $this->view->qid = $id; //for linking to question report page using same ID
        $this->view->answers = $this->model->getAnswers($id); //get answers for specified question id
        $this->view->user = $this->user->getNameFromId($this->user->getUserId());
        $this->view->render('review/question');
    }
    
    public function replies($qid, $answerId) {
        if(!isset($qid)) {
            $GLOBALS['error']->addError('question', 'No question id specified');
        }
        if(!isset($answerId)) {
            $GLOBALS['error']->addError('answer', 'No answer id specified');
        }
        if($GLOBALS['error']->getErrorCount()>0) {
            $this->view->render('error/error');
        } else {
            $this->view->question = $this->question->getDetailById($qid);
            $this->view->answer = $this->answer->getAnswerById($answerId);
            $this->view->replies = $this->reply->getReplies($qid, $answerId, 9999);
            $this->view->render('review/replies');
        }
    }

}

?>