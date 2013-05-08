<?php
/**
* Allows reporting of content on the site, as decided by a user. 
*/
class Reporting extends Controller {
	public function __construct() {
		parent::__construct();
		$this->form = new Form();
		$this->writing = new Writing();
		$this->report = new Report();
		$this->user = new User();
	}
	
	/**
	* Main page called navigating to other report pages
	*/
	public function index() {
		$this->view->render("reporting/index");
	}
	
	/**
	* Render page containing writing report form 
	* @param $id the id of content to report
	*/
	public function writing($id) {
		if(!empty($id)) {
			$this->view->details = $this->writing->getDetailBy('content_id', $id); //Get writing details and feed to view
			$this->view->reasons = $this->report->getReportReasons(2);
			$this->view->id = $id; //Sending content id to form to submit as hidden field
			$this->view->render("reporting/writing");
		} else {
			echo 'Please supply a valid content id';
		}
	}
	
	/**
	* Processing data sent from writing page
	*/ 
	public function runwriting() {
		$formData = array( //Form to contain data sent from writing report
		'reason' => '',
		'evidence' => '',
		'comments' => '',
		'content_id' => '');
		$formData = $this->form->getFormContent($formData); //Getting form data from writing report
		$this->model->runReportWriting($formData); //calling to model in order to submit/process data
		header("Location:".ROOT.'read/writing/'.$formData['content_id']);
	}
	
	/**
	* Render page containing user report form 
	* @param $id the id of user to report
	*/
	public function user($id) {
		if(!empty($id)) {
			$this->view->details = $this->user->getDetailFromId($id); //Get writing details and feed to view
			$this->view->reasons = $this->report->getReportReasons(1);
			$this->view->id = $id; //Sending content id to form to submit as hidden field
			$this->view->render("reporting/user");
		} else {
			echo 'Please supply a valid content id';
		}
	}
	
	/**
	* Processing data sent from user page
	*/
	public function runuser() {
		$formData = array( //Form to contain data sent from writing report
		'reason' => '',
		'evidence' => '',
		'comments' => '',
		'content_id' => '');
		$formData = $this->form->getFormContent($formData); //Getting form data from writing report
		$this->model->runReportUser($formData); //calling to model in order to submit/process data
		header("Location:".ROOT.'profile/user/'.$formData['content_id']);
	}
}
?>