<?php
class Mod_Redeem extends Controller {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->pagination = new Pagination();
		$this->form = new Form();
		$this->ban = new Ban();
		$this->report = new Report();
	}
	
	public function index() {
		$this->view->render('mod_redeem/index');
	}
}

?>

