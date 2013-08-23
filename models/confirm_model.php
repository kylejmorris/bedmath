<?php
class Confirm_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function run($formData) {
                $answerDetail = $this->answer->getAnswerById($formData['answer_id']);
                $questionDetail = $this->question->getDetailById($formData['question_id']);
                $bid = $questionDetail['bid'];
                $tutorId = $answerDetail['user'];
                $type = 1; //Type of reputation to reward for, in this case for solving question.
                $this->points->addPoints($tutorId, $bid, 11, $questionDetail['asked_by']);
		$this->database->update('g0g1_answers', array('accepted'=>1), array('id'=>$formData['answer_id']));
                $this->reputation->addRep($tutorId, 1, 1, $questionDetail['topic'], $questionDetail['asked_by']);   
	}
}
?>