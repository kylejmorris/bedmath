<?php
/**
* Allows transactions of points between users on the site. 
*/
class Donate extends Controller {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
	}
	
	/**
	* Currently redirects to donate/points page, until a main navigation is created. 
	*/
	public function index() {
		header('Location:'.ROOT.'donate/points'); 
	}
	
	/**
	* Displays form allowing user to donate points
	*/
	public function points() {
		$this->view->render("donate/points");
	}
	
	/**
	* Called after donate points form is filled. Will parse data and conduct actions required. 
	*/
	public function runPoints() {
		$formData = array( //The form element names to get data from 
		'receiver' => array(
					'required'=>true,
					'min_length'=>3,
					'max_length'=>16,
					'username_exists'=>true
					),
		'points' => array(
					'required'=>true,
					'is_numeric'=>true,
					'min_value'=>1
					)
		);
		$form = new Form($formData);
		if($form->isValid()) {
			$formData = $form->getFormData();
			$receiverId = $this->user->nameToId($formData['receiver']); //Converts the name of receiver to userid
			$senderId = Session::get("user_id"); //Getting userid of user who is donating the points
			if($this->user->exists($receiverId)) {
				$this->model->runPoints($formData, $receiverId, $senderId); //Process in model by sending in form information, receivers id, and senders id
				header('Location: '.ROOT.'/donate/success');
			}
		}
		$this->view->render('donate/points');
		
	}
	
	/**
	* Displays confirmation that donation was succesfull
	*/
	public function success() {
		$this->view->render("donate/success");
	}
}
?>