<?php

/**
 * Allows reporting of content on the site, as decided by a user. 
 */
class Reporting extends Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->user->isLoggedIn()) {
            $_SESSION['returnPage'] = $_GET['url'];
            header('Location: ' . ROOT . 'login', TRUE, 302);
        }
    }

    /**
     * Main page called navigating to other report pages
     */
    public function index() {
        $this->view->render("reporting/index");
    }

    /**
     * Render page containing user report form 
     * @param $id the id of user to report
     */
    public function user($id) {
        if(empty($id)) {
            $GLOBALS['error']->addError('user', 'Please specify a user');
        }
        if ($GLOBALS['error']->getErrorCount('any')==0) {
            $this->view->details = $this->user->getDetailFromId($id); //Get writing details and feed to view
            $this->view->reasons = $this->report->getReportReasons(1);
            $this->view->id = $id; //Sending content id to form to submit as hidden field
            $this->view->render("reporting/user", array('mathjax'));
        } else {
            $this->view->render("reporting/user", array('mathjax'));
        }
    }

    /**
     * Processing data sent from user page
     */
    public function runuser() {
        $formData = array(//Getting data from login form
            "reason" => array(
                'required' => true,
            ),
            "evidence" => array(
                'required' => true,
                'min_length' => 1,
                'max_length' => 1000
            ),
            "comments" => array(
                'max_length' => 1000
            ),
            "content_id" => array(
                'required' => true,
                'is_numeric' => true
        ));
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runReportUser($formData);
        }
        header("Location:" . ROOT . 'profile/user/' . $formData['content_id']);
    }

    /**
     * Render page containing question report form 
     * @param $qid the id of question to report
     */
    public function question($qid) {
        if ($qid == null) {
            $GLOBALS['error']->addError('question', 'No question id specified');
        }
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if ($GLOBALS['error']->getErrorCount('any') == 0) {

            $this->view->question = $this->question->getDetailById($qid);
            $this->view->reasons = $this->report->getReportReasons(3);
            $this->view->render('reporting/question');
        } else {
            $this->view->render('reporting/question');
        }
    }

    public function runquestion() {
        $formData = array(
            'reason' => array(
                'required' => true
            ),
            'evidence' => array(
                'required' => false
            ),
            'comments' => array(
                'required' => false
            ),
            'content_id' => array(
                'required' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runReportQuestion($formData);
            header('Location: ' . ROOT . 'questions');
        }
        $this->view->render('reporting/question');
    }
    
    /**
     * Report answer on site.
     * @param type $aid answer's id.
     */
    public function answer($aid) {
        if ($aid == null) {
            $GLOBALS['error']->addError('answer', 'No answer id specified');
        }
        if (!$this->answer->exists($aid)) {
            $GLOBALS['error']->addError('answer', 'Answer does not exist');
        }
        if ($GLOBALS['error']->getErrorCount('any') == 0) {
            $this->view->answer = $this->model->getAnswer($aid);
            $this->view->reasons = $this->report->getReportReasons(4);
            $this->view->render('reporting/answer');
        } else {
            $this->view->render('reporting/answer');
        }
    }
    
    public function runAnswer() {
        $formData = array(
            'reason' => array(
                'required' => true
            ),
            'evidence' => array(
                'required' => false
            ),
            'comments' => array(
                'required' => false
            ),
            'content_id' => array(
                'required' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runReportAnswer($formData);
            $question = $this->question->getQuestionByAnswer($formData['content_id']);
            header('Location: ' . ROOT . 'review/question/'.$question['id']);
        }
        $this->view->render('reporting/answer');
    }

}

?>