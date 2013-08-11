<?php
/**
* The default page for site. 
*/
class About extends Controller {

	/**
        * Renders main front page of site.
        */
	function __construct() {
            parent::__construct();            
	}
        
        public function index() {
             $this->view->render("about/index");
        }
}

?>