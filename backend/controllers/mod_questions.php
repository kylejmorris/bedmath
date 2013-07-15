<?php

class Mod_Questions extends Controller {

    public function __construct() {
        parent::__construct();
        $this->question = new Question();
        $this->user = new User();
        $this->pagination = new Pagination();
        $this->form = new Form();
        $this->category = new Category();
    }

    public function index() {
        $this->view->summary = $this->model->getSummary();
        $this->view->render('mod_questions/index');
    }

    /**
     * Loads question history
     */
    public function history($page, $topic, $user) {
        $this->view->topics = $this->category->getCategories();
        $this->view->currentTopic = array('id' => $topic, 'name' => $this->category->getNameFromId($topic)); //Pass current topic to highlight in topic selection form.
        $this->view->user = $user; //Passing user value to show in form as current user value.
        if ($page == null) {
            $page = 1;
        }
        if ($user == 'anyuser') {
            $user = null;
        }
        if ($topic == 'anytopic') {
            $topic = null;
        }
        $userId = $this->user->nameToId($user);
        if ($user != null && !$this->user->exists($userId)) {
            $GLOBALS['error']->addError('user', 'That user does not exist');
        } else {
            $this->view->pagination = $this->pagination->getPageList($page, 25, $this->question->getQuestionCount(array('topic' => $topic, 'asked_by' => $user)));
            $this->view->questions = $this->model->getHistory($page, $topic, $user);
        }

        $this->view->render('mod_questions/history');
    }

    /**
     * Allow detailed summary of individual question and it's corresponding answers.
     * @param type $qid
     * @param type $version
     */
    public function review($qid, $version) {
        if ($qid != null) {
            if(!$this->question->exists($qid)) {
                $GLOBALS['error']->addError('question', 'Invalid question id');
            } else {
                $this->view->questionSummary = $this->model->getQuestionReviewSummary($qid, $version);
                $this->view->answers = $this->model->getReviewAnswers($qid);
            }
        } else {
            $GLOBALS['error']->addError('question', 'Please supply a question id.');
        }
        $this->view->render('mod_questions/review');
    }
    
    /**
     * Allow staff member editing rights to a question posted.
     */
    public function edit($qid) {
        if (!$this->question->exists($qid)) {
            $GLOBALS['error']->addError('question', 'Question does not exist');
        }
        if ($GLOBALS['error']->getErrorCount('question') > 0) {
            $this->view->render('error/error');
        } else {
            $this->view->qid = $qid;
            $this->view->topics = $this->category->getCategories();
            $this->view->question = $this->question->getDetailById($qid);
            $this->view->render('mod_questions/edit');
        }
    }
    
    public function runEdit($qid) {
        $formData = array(
            'title' => array(
                'require' => true,
                'min_length' => 3,
                'max_length' => 64
            ),
            'topic' => array(
                'required' => true
            ),
            'full' => array(
                'min_length' => 1,
                'max_length' => 5012
            ),
            'bid' => array(
                'required' => true
            ),
            'published' => array(
                'required' => true
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $this->model->runEditQuestion($qid, $formData);
            $this->view->render('mod_questions/edit_success');
        } else {
            $this->view->render('error/error');
        }
    }

}

?>