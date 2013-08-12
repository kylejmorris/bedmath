<?php
/**
* Listing of site users along with their basic details. Navigation to user profile. 
*/
class Members extends Controller {
	public function __construct() {
		parent::__construct();
	}

	/**
	* Loads page() method, just placeholder considering there is no real index page at this time. 
	*/
	public function index() {
		$this->page(1); 
	}
	
	/**
	* Used to create user list to display on page. 
	* @param $page The page you are currently on, in terms of viewing users.
	* @param $count The amount of users to display per page
	*/
	public function page($page) {
		if(empty($page)) {
			$page = 1; 
		}
		$count = 5; 
		$userList = $this->model->getUsers($page, $count, 'user_id'); //Returning user list information for MemberList Feature
		$stats = $this->model->getMemberStats(); //Grabbing statistics used in page summary, describing members on GlobeOfGeek ex(we have --- members, with ---- points)
		$userCount = $this->user->userCount(); //Get number of users in database
		$this->view->page = $page; //Passing page value to view
		$this->view->count = $count; //Passing count value to view
		$this->view->userList = $userList;
		$this->view->stats = $stats;
		$this->view->pagination = $this->pagination->getPageList($page, $count, $userCount); 
		$this->view->render("members/index");
		
	}
}
?>
