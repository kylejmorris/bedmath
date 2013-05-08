<?php
class Review extends Controller {
    public function __construct() {
		parent::__construct();
		$this->question = new Question();
	}
	
	/**
	*
	*/
	public function question($id) { 
		$this->view->question = $this->model->question($id);
		$this->view->qid = $id; //for linking to question report page using same ID
		$this->view->answers = $this->model->getAnswers($id); //get answers for specified question id
		$this->view->render('review/question');
	}
}
?>