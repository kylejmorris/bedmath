<?php
class GiveReply_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->question = new Question();
		$this->answer = new Answer();
                $this->reply = new Reply();
	}
	

	public function runQuestion($userId, $qid, $answerId, $formData) {
            $time = time();
            $columns = array('answer_id'=>$answerId, 'question_id'=>$qid, 'user_id'=>$userId, 'full_text'=>$formData['full_text'], 'time'=>$time);
            $this->reply->addReply($columns);
		
	}
}

?>