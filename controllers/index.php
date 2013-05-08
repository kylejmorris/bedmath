<?php
/**
* The default page for site. 
*/
class Index extends Controller {

	/**
        * Renders main front page of site.
        */
	function __construct() {
		parent::__construct();  
		$this->view->render("index/index");
	}
        
        public function index() {
            
        }
}

?>