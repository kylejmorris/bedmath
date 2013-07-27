<?php

/**
 * Allows user to login to their site account. 
 */
class Login extends Controller {

    function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->ban = new Ban();
    }

    /**
     * Loads default login page
     */
    function index() {
        $this->view->render('login/index', array('header', 'footer'));
    }

    /**
     * Called when login form is submitted. 
     * Will call model to validate user info
     */
    function run() {
        $formData = array(//Getting data from login form
            "username" => array(
                'required' => true,
                'min_length' => 3,
                'max_length' => 16,
                'username_exists' => true
            ),
            "password" => array(
                'required' => true,
                'min_length' => 6,
                'max_length' => 128
        ));
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $userId = $this->model->run($formData);
            if ($userId != false) { //If valid login was returned, and succesfull 
                if (!$this->user->isBanned($userId)) {
                    //Session::set('user_id', $userId); //Login user session
                    $this->user->login($userId);
                    header("Location:../index");
                } else {
                    //Session::set('user_id', $userId); //Login user session
                    $this->user->login($userId);
                    header("Location:" . ROOT . 'login/banned');
                }
            } else {
                $GLOBALS['error']->addError('user', 'Username or password is incorrect');
            }
        }
        $this->view->render('login/index', array('header', 'footer'));
    }

    /**
     * Ends users logged in session, returning them to public view. 
     */
    function logout() {
        $this->user->logout($this->user->getUserId());
        header("Location:../index");
    }

    /**
     * Loaded if user level is 0, meaning banned
     */
    public function banned() {
        $userId = $this->user->getUserId();
        $expired = $this->ban->banExpired($userId);
        if ($expired) {
            $this->ban->unban($userId);
            $this->view->render('login/unbanned');
        } else {
            $this->view->details = $this->ban->getBanDetails($userId);
            $this->user->logout($this->user->getUserId());
            $this->view->render('login/banned');
        }
    }

}

?>
