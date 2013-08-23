<?php

class Activate extends Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user->isLoggedIn()) {
                $_SESSION['returnPage'] = $_GET['url'];
                header('Location: ' . ROOT . 'login', TRUE, 302);
        } else {
            if($this->user->isActivated($this->user->getUserId())) {
                header('Location: '. ROOT.'index');
            }
        }
    }

    public function index() {
        $this->view->userId = $this->user->getUserId();
        $this->view->render('activate/index', array('mathjax', 'ckeditor'));
    }

    public function sendActivation($id) {
        if ($this->user->exists($id) && $this->user->isActivated($id) == false) {
            $this->user->setActivationCode($id);
            $this->email->generateDefaultMail(7, $id);
            $userDetails = $this->user->getDetailFromId($id);
            $address = $userDetails['email']; //Retrieving users email from details array
            $this->email->sendMail($address);
            $this->view->render('activate/sent', array('mathjax', 'ckeditor'));
        }
    }
    
    /**
     * Link directed from email, allowing user to confirm/activate their account.
     * @param type $id the userid
     * @param type $code activation code.
     */
    public function validate($id, $code) {
        if($this->user->checkActivation($id, $code)) {
            $this->user->setActivation($id);
            $this->view->render('activate/success');
        } else {
            $this->view->render('activate/denied');
        }
    }

}

?>
