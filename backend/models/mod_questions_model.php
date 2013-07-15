<?php

class Mod_Questions_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->question = new Question();
        $this->pagination = new Pagination();
        $this->category = new Category();
        $this->answer = new Answer();
        $this->reply = new Reply();
    }

    public function getSummary() {
        $summary = array('total_questions' => '', 'asked_today' => '', 'total_answered' => '');
        $summary['total_questions'] = $this->question->getQuestionCount();
        $time = time(); //Timestamp for certain data needs.
        $summary['asked_today'] = $this->question->getQuestionCount(array('asked_time' => array($time - 86400, '>')));
        $summary['total_answered'] = $this->question->getSolvedCount(null, null);
        return $summary;
    }

    public function getHistory($page, $topic, $user) {
        $questions = $this->question->getQuestions(array('topic' => $topic, 'asked_by' => $user), 'asked_time', $page, 25);
        for ($c = 0; $c < sizeof($questions); $c++) {
            array_push($questions[$c], 'username');
            array_push($questions[$c], 'answer_count');
            array_push($questions[$c], 'solved'); //True or false, based on if question is solved or not.
            $questions[$c]['username'] = $this->user->getNameFromId($questions[$c]['asked_by']);
            $questions[$c]['topic'] = $this->category->getNameFromId($questions[$c]['topic']);
            $questions[$c]['answer_count'] = $this->answer->getAnswerCount(array('question_id'=>$questions[$c]['id']));
            if($this->question->isSolved($questions[$c]['id'])) {
                $questions[$c]['solved'] = 'solved';
            } else {
                $questions[$c]['solved'] = 'unsolved';
            }
            
        }
        return $questions;
    }

    public function getQuestionReviewSummary($qid, $version) {
        if ($version == null || $version==$this->question->getQuestionVersion($qid)) { //If null or set as current version.
            $summary = $this->question->getDetailById($qid);
            array_push($summary, 'asked_by_name'); //Full username instead of just user_id.
            array_push($summary, 'version'); //Get current question version.
            $summary['asked_by_name'] = $this->user->getNameFromId($summary['asked_by']);
            $summary['version'] = $this->question->getQuestionVersion($qid);
        } else {
            $summary = $this->question->getDetailByVersion($qid, $version);
            array_push($summary, 'id'); //Need to set different key for question id, as table columns are differently named.
            $summary['id'] = $summary['question_id'];
            unset($summary['question_id']);
            array_push($summary, 'asked_by_name'); //Full username instead of just user_id.
            array_push($summary, 'version'); //Get current question version.
            $summary['asked_by_name'] = $this->user->getNameFromId($summary['asked_by']);
        }
        array_push($summary, 'answer_count'); //Hold answers for question.
        array_push($summary, 'solved'); //Holds true/false based on if question is solved or not
        $summary['answer_count'] = $this->question->getAnswerCount($qid);
        $summary['solved'] = $this->question->isSolved($qid);
        return $summary;
    }
    
    public function getReviewAnswers($qid) {
        $answers = $this->answer->getAnswersByQuestion($qid);
        for($c=0; $c<sizeof($answers); $c++) {
            array_push($answers[$c], 'username'); //String version of username, not userid.
            $answers[$c]['username'] = $this->user->getNameFromId($answers[$c]['user']);
            $answers[$c]['reply_count'] = $this->reply->getReplyCount($qid, $answers[$c]['id']);
        }
        return $answers;
    }
    
    public function runEditQuestion($qid, $details) {
        $this->question->update($qid, $details);
    }
}

?>