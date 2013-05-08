<?php
class Review_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->question = new Question();
		$this->answer = new Answer();
	}
	

	public function question($id) {
		$questionData = $this->question->getDetailById($id);
		$questionData['asked_by'] = $this->user->getNameFromId($questionData['asked_by']);
		return $questionData;
	}
	
	public function getAnswers($id) {
		$answers = $this->answer->getAnswersByQuestion($id);
		for($c=0; $c<sizeof($answers); $c++) {
			$answers[$c]['user'] = $this->user->getNameFromId($answers[$c]['user']);
		}
		return $answers;
	}
}

?>