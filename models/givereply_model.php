<?php
class GiveReply_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	

	public function runQuestion($userId, $qid, $answerId, $formData) {
            $time = time();
            $columns = array('answer_id'=>$answerId, 'question_id'=>$qid, 'user_id'=>$userId, 'full_text'=>$formData['full_text'], 'time'=>$time);
            $this->reply->addReply($columns);
	}
}

?>