<?php
class Mod_Users extends Controller {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->pagination = new Pagination();
		$this->form = new Form();
		$this->ban = new Ban();
		$this->report = new Report();
	}
	
	public function index() {
		$this->view->stats = $this->model->getUserStats();
		$this->view->render('mod_users/index');
	}
	
	/**
	* Lists users registered on site, along with basic information. 
	* @param $page the page number to display, default is 1
	* @param $limit the maximum number of users to display per page, default is 10. 
	*/
	public function view($page, $limit, $order='user_id') {
		if(empty($page)) {
			$page = 1;
		}
		if(empty($limit)) {
			$limit = 10;
		}
		$totalUsers = $this->user->userCount();
		$this->view->limit = $limit;
		$this->view->pagination = $this->pagination->getPageList($page, $limit, $totalUsers);
		$this->view->users = $this->user->getUsers($page, $limit, $order);
		$this->view->render("mod_users/view");
	}
	
	/**
	* Generates page allowing changes to be made in user account. 
	*/
	public function edit($userId) {
		$this->view->details = $this->user->getDetailFromId($userId);
		$this->view->render('mod_users/edit');
	}
	
	public function newban($userId) {
		$this->view->reasons = $this->report->getReportReasons();
		$this->view->details = $this->user->getDetailFromId($userId);
		$this->view->render('mod_users/newban');
	}
	
	public function runNewBan($userId) {
		$form = array( 'length' => '', 
				'comments' => ''
				);
		$formData = $this->form->getFormContent($form);
		$this->model->runNewBan($userId, $formData);
		header('Location:'.ROOT.'mod/mod_users/view');
	}
	
	/**
	* Called upon run form being submitted. Processess form data and makes changes to user if specified. 
	*/
	public function runEdit($userId) {
		$form = array(
		'username' => '',
		'email' => '',
		'password' => '',
		'activated' => '',
		'user_level' => '');
		$formData = $this->form->getFormContent($form);
		$this->model->runEdit($userId, $formData);
		header('Location:'.ROOT.'mod/mod_users/edit/'.$userId);
	}
	
	public function bans($page, $count, $time, $userId) {
		if(empty($page)){$page=1;}
		if(empty($count)){$count=10;}
		if(empty($time)){$time=null;}
		if(empty($userId)){$userId=null;}
		$banCount = $this->ban->getBanCount();
		$this->view->pagination = $this->pagination->getPageList($page, $count, $banCount);
		$this->view->count = $count;
		$this->view->bans = $this->ban->getBanHistory($page, $count, $time, $userId);
		$this->view->render('mod_users/bans');
		
	}
}

?>

