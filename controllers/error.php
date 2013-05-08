<?php
class Error extends Controller {
public $page = 'error/error';
	function __construct() {
		parent::__construct();
		$this->view->render($this->page);		
	}
	
	public function index() {
		echo 'yolo';
	}
}
?>