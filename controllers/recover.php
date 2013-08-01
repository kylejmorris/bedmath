<?php
class Recover extends Controller {
	public function __construct() {
		parent::__construct();
		$this->form = new Form();
		$this->user = new User();
		$this->email = new Email();
                if(!$this->user->isLoggedIn()) {
                    $_SESSION['returnPage'] = $_GET['url'];
                    header('Location: '.ROOT.'login', TRUE, 302);
                }
	}
	
	public function index() {
		$this->view->render('recover/index', array('header', 'footer'));
	}
	
	/**
	* Takes validation code sent to use in email and compares to the one stored on server.
	* @param $userId The id of user to run activation code on.
	* @param $code The 32 character code to validate. 
	*/
	public function validate($userId, $code) {
		if($this->user->checkActivation($userId, $code)) {
			$this->user->login($userId);
			$this->view->render('recover/confirmed');
		}
	}
	
	public function runRecovery() {
		$form = array('username'=>'');
		$formData = $this->form->getFormContent($form);
		$userId = $this->user->nameToId($formData['username']);
		if($this->user->exists($userId)) {
			$this->user->setActivationCode($userId);
			$this->email->generateDefaultMail(4, $userId);
			$userDetails = $this->user->getDetailFromId($userId);
			$email = $userDetails['email']; //Retrieving users email from details array
			$this->email->sendMail($email);
		}
	}
}

?>