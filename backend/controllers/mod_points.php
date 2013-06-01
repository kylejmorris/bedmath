<?php

class Mod_Points extends Controller {

    public function __construct() {
        parent::__construct();
        $this->points = new Points();
        $this->user = new User();
        $this->pagination = new Pagination();
        $this->form = new Form();
    }

    public function index() {
        $this->view->stats = $this->model->getPointsStats();
        $this->view->render('mod_points/index');
    }

    public function edit($id) {
        $this->view->details = $this->user->getDetailFromId($id);
        $this->view->render('mod_points/edit');
    }

    public function runEdit() {
        $form = array('points' => '', 'user_id' => '');
        $formData = $this->form->getFormContent($form);
        $this->model->runEdit($formData);
        header('Location:' . ROOT . 'mod/mod_points/viewusers');
    }

    public function viewUsers($page, $limit, $order) {
        if (empty($page)) {
            $page = 1;
        }
        if (empty($limit)) {
            $limit = 10;
        }
        $totalUsers = $this->user->userCount();
        $this->view->limit = $limit;
        $this->view->pagination = $this->pagination->getPageList($page, $limit, $totalUsers);
        //$this->view->users = $this->user->getUsers($page, $limit, $order);
        $this->view->users = $this->model->viewUsers($page, $limit, $order);
        $this->view->render("mod_points/viewusers");
    }

    public function transactions($page, $count, $type, $time, $userId) {
        $userId = $this->user->nameToId($userId);
        if (empty($page)) {
            $page = 1;
        }
        if (empty($count)) {
            $count = 10;
        }
        if (empty($time)) {
            $time = null;
        }
        if (empty($type)) {
            $type = null;
        }
        if (empty($userId)) {
            $userId = null;
        }
        $this->view->transactions = $this->model->transactions($page, $count, $type, $time, $userId);
        $transactionCount = $this->points->getTransactionCount();
        $this->view->pagination = $this->pagination->getPageList($page, $count, $transactionCount);
        $this->view->page = $page; //Current page
        $this->view->count = $count; //Max amount of users per page
        $this->view->type = $type; //Currently selected type of transactions to view
        $this->view->transactionTypes = $this->points->getTransactionTypes(); //Lists all transaction types to select
        $this->view->render('mod_points/transactions');
    }

}

?>