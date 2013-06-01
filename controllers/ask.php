<?php
class Ask extends Controller {
    public function __construct() {
		parent::__construct();
		$this->category = new Category();
	}
	
	public function index() {
		$this->view->topics = $this->category->getCategories();
		$this->view->render('ask/index');
	}
	
	public function runAsk() {
		$formData = array(
			'title' => array(
						'required'=>true,
						'min_length'=>3,
						'max_length'=>64
			),
			'topic' => array(
						'required'=>true
			),
			'full' => array(
						'min_length'=>1,
						'max_length'=>1024
			),
			'bid' => array(
						'required'=>true,
						'is_numeric'=>true,
						'min_value'=>10
			)	
		);		
		$form = new Form($formData);
		if($form->isValid()) {
			$formData = $form->getFormData();
			$this->model->runAsk($formData);
//header('Location: '.ROOT.'/questions/');
		} else {
			$this->index();
		}
	}
}
?>