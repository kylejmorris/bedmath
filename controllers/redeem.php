<?php

class Redeem extends Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user->isLoggedIn()) {
            $_SESSION['returnPage'] = $_GET['url'];
            header('Location: ' . ROOT . 'login', TRUE, 302);
        }
    }

    public function index() {
                $this->points->hasPendingRedeemRequest($userId);
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
        if ($this->model->confirmChecks()) {
            if ($form->isValid() && $GLOBALS['error']->getErrorCount() == 0) {
                $formData = $form->getFormData();
                if ($formData['redeem_amount'] > $this->points->getPoints($userId)) {
                    $GLOBALS['error']->addError('points', 'You do not have enough points to redeem that amount.');
                }
                if ($GLOBALS['error']->getErrorCount('all') == 0) {
                    $this->model->runRedeem($formData, $userId);
                    header("Location: " . ROOT . 'redeem/success');
                }
            }
        }
        $this->index();
    }

    public function success() {
        $this->view->render('redeem/success', array('mathjax'));
    }

}

?>