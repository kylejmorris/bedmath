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
        if ($this->user->isLoggedIn()) {
            header('Location: ' . ROOT . 'account', TRUE, 302);
        } else {
            $this->view->render('index/index', array('ckeditor'));
        }
    }

    public function index() {
        
    }

}

?>