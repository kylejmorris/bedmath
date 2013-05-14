<?php
class Review extends Controller {
    public function __construct() {
		parent::__construct();
		$this->question = new Question();
                $this->user = new User();
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
}
?>