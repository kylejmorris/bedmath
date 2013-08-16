<?php

class Redeem extends Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->user->isLoggedIn()) {
                    $_SESSION['returnPage'] = $_GET['url'];
                    header('Location: '.ROOT.'login', TRUE, 302);
         }
    }

    public function index() {
        $this->view->checks = $this->model->getChecks(); //displaying checks to user before they send redeem request. Showing things suggested, and required.
        $this->view->render('redeem/index', array('mathjax'));
    }

    public function run() {
        $userId = $this->user->getUserId();
        if ($userId == null) {
            $GLOBALS['error']->addError('user', 'You must be logged in to redeem');
        }
        $formData = array(
            'redeem_amount' => array(
                'required' => true,
                'is_numeric' => true,
                'min_value' => 1000
            )
        );
        $form = new Form($formData);
        if ($form->isValid() && $GLOBALS['error']->getErrorCount() == 0) {
            $formData = $form->getFormData();
            if ($GLOBALS['error']->getErrorCount() == 0) {
                $this->model->runRedeem($formData, $userId);
                header("Location: " . ROOT . 'redeem/success');
            }
        } else {
            $this->view->render('redeem/index', array('mathjax'));
        }
    }

    public function success() {
        $this->view->render('redeem/success', array('mathjax'));
    }

}

?>