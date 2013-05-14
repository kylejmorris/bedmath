<?php

/**
 * Allows visitor to register new account. 
 */
class Register extends Controller {

    function __construct() {
        parent::__construct();
        $this->user = new User();
        if (Session::exists('user_id')) {
            header('Location:' . ROOT);
            $error->showErrors();
        }
    }

    /**
     * Main page to display registration form. This is if nor referral link was given to find this page. 
     */
    public function index() {
        $this->view->render('register/index');
    }

    /**
     * Generates same stuff as index, except contains value of $ref in invited form area. 
     * @param $ref the username of referral/invite user. 
     * This user will obtain credit from bringing a new user to the site. 
     */
    function r($ref) {
        $this->view->ref = $ref; //Send user ref code from url as referral name. Auto places it if link contains the name
        $this->view->render('register/index');
    }

    /**
     * Called upon registration form being submitted, registers user on site. 
     */
    public function run() {
        $formData = array(
            'username' => array(
                'required' => true,
                'min_length' => 3,
                'max_length' => 16
            ),
            'password' => array(
                'required' => true,
                'min_length' => 6,
                'max_length' => 128
            ),
            'email' => array(
                'required' => true,
                'email_valid' => true
            ),
            'invited_by' => array(
                'username_exists' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            if (!$this->user->usernameExists($formData['username'])) {
                $userId = $this->model->runRegister($formData); //Making new user account and returning ID of the new user.
                Session::set('user_id', $userId); //Setting session for new user, basically logging them in
                header("Location:" . ROOT . 'profile/user/' . $userId); //Redirecting new user to their own profile! woohoo
            } else {
                $GLOBALS['error']->addError('user', 'The user ' . $formData['username'] . ' already exists');
            }
        }
        $this->view->render('register/index');
    }

}

?>