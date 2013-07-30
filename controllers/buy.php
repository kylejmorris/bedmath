<?php
/**
* Allows purchasing of points on the site.
*/
class Buy extends Controller {
  public function __construct() {
		parent::__construct();
		$this->user = new User();
	}
	
	/**
	* Currently redirects to donate/points page, until a main navigation is created. 
	*/
	public function index() {
		header('Location:'.ROOT.'buy/points'); 
	}
	
	/**
	* Displays form allowing user to donate points
	*/
	public function points() {
                $this->view->userId = $this->user->getUserId();
		$this->view->render("buy/points");
	}
	
	/**
	* Displays confirmation that donation was succesful
	*/
	public function success() {
		$this->view->render("buy/success");
	}
}
?>
