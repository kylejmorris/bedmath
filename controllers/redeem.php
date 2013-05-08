<?php
class Redeem extends Controller {
    public function __construct() {
		parent::__construct();
		$this->form = new Form();
		$this->user = new User();
		$this->pagination = new Pagination();
	}
	
	public function index() {
		$this->view->render('redeem/index');
	}
	
	public function run() {
		$userId = $this->user->getUserId();
		if($userId==null) {
			$GLOBALS['error']->addError('user', 'You must be logged in to redeem!');
		}
		$formData = array(
			'redeem_amount' => array(
						'required'=>true,
						'is_numeric'=>true,
						'min_value'=>1000
			)
		);
		$form = new Form($formData);
		if($form->isValid()) {
			$formData = $form->getFormData();
			if($GLOBALS['error']->getErrorCount()==0) {
				$this->model->runRedeem($formData, $userId);
			}
			header("Location: ".ROOT.'redeem');
		} else {
			$this->view->render('redeem/index');
		}	
	}
	
	public function success() {
	
	}
}
?>