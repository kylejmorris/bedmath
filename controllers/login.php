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
        $this->view->returnPage = $_SERVER['HTTP_REFERER'];
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
            ),
            "returnPage" => array(
        ));
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $userId = $this->model->run($formData);
            if ($userId != false) { //If valid login was returned, and succesfull 
                if (!$this->user->isBanned($userId)) {
                    $this->user->login($userId);
                    if (strpos($formData['returnPage'], 'login') === false && !$formData['returnPage']=="") { //Return user to page they came from.
                        header('Location: ' . $formData['returnPage']);
                    } else {
                        if(isset($_SESSION['returnPage'])) {
                            header("Location: ".ROOT.$_SESSION['returnPage']); //backup, takes session from page when redirected to login.
                            unset($_SESSION['returnPage']);
                        } else {
                            header("Location:../account"); //Put on account page if all else fails.
                        }
                    }
                } else {
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
