<?php
class Confirm extends Controller {
    public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->answer = new Answer();
		$this->question = new Question();
	}
	
	public function index() {
		$this->question();
	}
	
	/**
	* Allow user to select answer for their posted question.
	* @param $qid the question id
	* @param $aid the id of answer to select.
	*/
	public function question($qid, $aid) {
		if(empty($qid)) {
			$GLOBALS['error']->addError('question', 'Please supply question id');
		}
		if(empty($aid)) {
				$GLOBALS['error']->addError('answer', 'Please supply answer ID');
		} else {
			if(!$this->answer->exists($aid)) {
				$GLOBALS['error']->addError('answer', 'Invalid Answer ID');
			}
		}
		$answer = $this->answer->getAnswerById($aid);
		if(!$this->question->exists($qid)) {
			$GLOBALS['error']->addError('question', 'The specified question does not exist');
		} else {
			$question = $this->question->getDetailById($qid);
			if($question['asked_by']!=$this->user->getUserId()) {
				$GLOBALS['error']->addError('question', 'You did not ask this question');
			}
		}
		if($this->question->isSolved($qid)) {
			$GLOBALS['error']->addError('question', 'This question is already solved');
		}
		
		if($answer['question_id']!=$qid) {
			$GLOBALS['error']->addError('answer', 'The specified answer does not belong with the proper question');
		}
		if($GLOBALS['error']->getErrorCount('all')==0) {
			$this->view->answerDetail = $this->answer->getAnswerById($aid);
			$this->view->tutorName = $this->user->getNameFromId($this->view->answerDetail['user']);
			$this->view->render('confirm/question');
		} else {
			$this->view->render('error/error');
		}
	}
	
	public function run() {
		$formData = array('question_id'=>array('required'=>true, 'is_numeric'=>true),
						'answer_id'=>array('required'=>true, 'is_numeric'=>true));
		$form = new Form($formData);
		if($form->isValid()) {
			$formData = $form->getFormData();
			$this->model->run($formData);
		}
                header("Location: ".ROOT.'account/questions/');
	}
}
?>