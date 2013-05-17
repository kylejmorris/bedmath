<?php

class Questions_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->question = new Question();
        $this->answer = new Answer();
        $this->user = new User();
        $this->category = new Category();
    }

    public function view($page, $where, $limit) {
        $questions = $this->question->getQuestions($where, 'asked_time', $page, $limit);
        for ($c = 0; $c < sizeof($questions); $c++) {
            array_push($questions[$c], 'answer_count');
            array_push($questions[$c], 'avatar');
            $questions[$c]['answer_count'] = $this->question->getAnswerCount($questions[$c]['id']);
            $questions[$c]['asked_by'] = $this->user->getNameFromId($questions[$c]['asked_by']);
            $questions[$c]['topic'] = $this->category->getNameFromId($questions[$c]['topic']);
            $image = new Image();
            $userDetail = $this->user->getDetailFromId($this->user->nameToId($questions[$c]['asked_by'])); //Getting users information to find avatar id.
            $image->getImageByContent(3, $userDetail['avatar_id']); //Getting profile image of user
            $questions[$c]['avatar'] = $image; //Sending image object back to display on view.
        }
        if (sizeof($questions) == 0) {
            $GLOBALS['error']->addError('question', 'No questions available at this time');
        }
        return $questions;
    }
    
    public function highest($page, $where, $limit) {
        $questions = $this->question->getQuestions($where, 'bid', $page, $limit);
        for ($c = 0; $c < sizeof($questions); $c++) {
            array_push($questions[$c], 'answer_count');
            array_push($questions[$c], 'avatar');
            $questions[$c]['answer_count'] = $this->question->getAnswerCount($questions[$c]['id']);
            $questions[$c]['asked_by'] = $this->user->getNameFromId($questions[$c]['asked_by']);
            $questions[$c]['topic'] = $this->category->getNameFromId($questions[$c]['topic']);
            $image = new Image();
            $userDetail = $this->user->getDetailFromId($this->user->nameToId($questions[$c]['asked_by'])); //Getting users information to find avatar id.
            $image->getImageByContent(3, $userDetail['avatar_id']); //Getting profile image of user
            $questions[$c]['avatar'] = $image; //Sending image object back to display on view.
        }
        if (sizeof($questions) == 0) {
            $GLOBALS['error']->addError('question', 'No questions available at this time');
        }
        return $questions;
    }
    
    public function unanswered($page, $where, $limit) {
        $questions = $this->question->getQuestions($where, array('id', 'DESC'), $page, $limit);
        for ($c = 0; $c < sizeof($questions); $c++) {
            array_push($questions[$c], 'answer_count');
            array_push($questions[$c], 'avatar');
            $questions[$c]['answer_count'] = $this->question->getAnswerCount($questions[$c]['id']);
            $questions[$c]['asked_by'] = $this->user->getNameFromId($questions[$c]['asked_by']);
            $questions[$c]['topic'] = $this->category->getNameFromId($questions[$c]['topic']);
            $image = new Image();
            $userDetail = $this->user->getDetailFromId($this->user->nameToId($questions[$c]['asked_by'])); //Getting users information to find avatar id.
            $image->getImageByContent(3, $userDetail['avatar_id']); //Getting profile image of user
            $questions[$c]['avatar'] = $image; //Sending image object back to display on view.
        }
        if (sizeof($questions) == 0) {
            $GLOBALS['error']->addError('question', 'No questions available at this time');
        }
        return $questions;
    }

}

?>