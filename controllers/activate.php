<?php

class Activate extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->userId = $this->user->getUserId();
        $this->view->render('activate/index');
    }

    public function sendActivation($id) {
        if ($this->user->exists($id) && $this->user->isActivated($id) == false) {
            $this->user->setActivationCode($id);
            $this->email->generateDefaultMail(7, $id);
            $userDetails = $this->user->getDetailFromId($id);
            $email = $userDetails['email']; //Retrieving users email from details array
            $this->email->sendMail($email);
            $this->view->render('activate/sent');
        }
    }

}

?>
