<?php
Class NewInvite extends Controller {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->email = new Email();
		$this->form = new Form();
	}
	
	public function index() {
		$this->view->username = $this->user->getNameFromId($this->user->getUserId());
		$this->email->generateDefaultMail(3, Session::get("user_id"));
		$this->view->emailBody = $this->email->message;
		$this->view->render('newinvite/index');
	}
	
	public function runInvite() {
		$form = array('to'=>'');
		$formData = $this->form->getFormContent($form);
                echo 'test';
		$formData['to'] = explode(',', $formData['to']);
		$to = "";
		for($c=0; $c<sizeof($formData['to']); $c++) {
			if(filter_var(str_replace(' ', '', $formData['to'][$c]), FILTER_VALIDATE_EMAIL)!=false) {
				$to .= $formData['to'][$c].',';
			}
		}
		$this->email->generateDefaultMail(3, $this->user->getUserId());
		$this->email->sendMail($to);
		header('Location: '.ROOT.'newinvite/index');
	}
}
?>