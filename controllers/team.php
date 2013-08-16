<?php
/**
* The default page for site. 
*/
class Team extends Controller {

	/**
        * Renders main front page of site.
        */
	function __construct() {
		parent::__construct();  
                $this->view->render("team/index", array('mathjax'));
	}
        
        public function index() {
            
        }
}

?>