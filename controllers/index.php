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
                $this->user = new User();
                $this->question = new Question();
                $this->view->userCount = $this->user->userCount();
                $this->view->answerCount = $this->question->getSolvedCount(null, null);   
                $this->view->render("index/index", array('header', 'footer'));
	}
        
        public function index() {

            
        }
}

?>