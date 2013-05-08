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
		for($c=0; $c<sizeof($questions); $c++) {
			array_push($questions[$c], 'answer_count');
			$questions[$c]['answer_count'] = $this->question->getAnswerCount($questions[$c]['id']);
			$questions[$c]['asked_by'] = $this->user->getNameFromId($questions[$c]['id']);
			$questions[$c]['topic'] = $this->category->getNameFromId($questions[$c]['topic']);
		}
		if(sizeof($questions)==0) {
			$GLOBALS['error']->addError('question', 'No questions available at this time');
		}
		return $questions;
	}
	
}

?>