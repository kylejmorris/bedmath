<?php
class ErrorPage extends Controller {
public $page = 'errorpage/error';
	function __construct() {
		parent::__construct();
		$this->view->render($this->page, array('ckeditor'));		
	}
	
	public function index() {
	}
}
?>