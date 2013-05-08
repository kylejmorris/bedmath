<?php
class Confirm_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function run($formData) {
		$this->database->update('g0g1_answers', array('accepted'=>1), array('id'=>$formData['answer_id']));
		$this->database->update('g0g1_questions', array('solved'=>1), array('id'=>$formData['question_id']));
	}
}
?>