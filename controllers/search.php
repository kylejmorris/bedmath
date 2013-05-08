<?php
class Search extends Controller {
    public function __construct() {
		parent::__construct();
		$this->form = new Form();
		$this->user = new User();
		$this->pagination = new Pagination();
	}
	
	public function index() {
		header('Location: '.ROOT.'index');
	}
	/**
	* Allows searching of site users
	* @param $query the main search query
	* @param $page the page of results being viewed
	* @param $limit the max display of results per page.
	*/
	public function users($query, $page, $limit) {
		if(empty($page)) {$page=1;} 
		if(empty($limit)) {$limit=10;}
		$form = array('query'=>'');
		$formData = $this->form->getFormContent($form);
		if(!empty($formData['query'])) {
			$query = $formData['query'];
		}
		$this->view->users = $this->user->searchUsers($query, $page, $limit);
		if(sizeof($this->view->users)>0) {
			$this->view->page = $page;
			$this->view->query = $query;
			$this->view->pagination = $this->pagination->getPageList($page, $limit, sizeof($this->view->users));
			$this->view->render('search/users');
		} else {
			$this->view->render('search/noresults');
		}
	}
}
?>