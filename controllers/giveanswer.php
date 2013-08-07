<?php

class GiveAnswer extends Controller {

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->answer = new Answer();
        if (!$this->user->isLoggedIn()) {
            $_SESSION['returnPage'] = $_GET['url'];
            header('Location: ' . ROOT . 'login', TRUE, 302);
        }
    }

    public function index() {
        
    }

    /**
     * Allow creation of answer by tutor, in response to selected question.
     * @param $id the question being answered.
     */
    public function question($id) {
        $this->view->question = $this->model->question($id);
        $this->view->potential = $this->model->getUserPotential($this->user->getUserId(), $id);
        $this->view->qid = $id; //passing question id to view for resubmission.
        if ($this->user->getUserId() == $this->user->nameToId($this->view->question['asked_by'])) {
            $GLOBALS['error']->addError('question', 'You cannot answer your own question.');
        }
        if ($GLOBALS['error']->getErrorCount() > 0) {
            $this->view->render('error/error');
            return false;
        }
        $this->view->render('giveanswer/question');
    }

    public function questionRun($id) {
        $formData = array(
            'answer' => array(
                'required' => true,
                'min_length' => 10,
                'max_length' => 10256
            )
        );
        $form = new Form($formData);
        if ($form->isValid()) {
            $formData = $form->getFormData();
            $userId = $this->user->getUserId();
            var_dump($userId);
            if ($userId != null) {
                $columns = array('question_id' => $id, 'user' => $userId, 'full_text' => $formData['answer'], 'time' => time(), 'published' => 1, 'activated' => 1, 'accepted' => 0);
                if (!$this->answer->addAnswer($id, $columns)) {
                    $GLOBALS['error']->addError('answer', 'An unknown error occured');
                }
            } else {
                $GLOBALS['error']->addError('user', 'You must be logged in');
            }
        }
        if ($GLOBALS['error']->getErrorCount() == 0) {
            header('Location: ' . ROOT . 'review/question/' . $id);
        } else {
            $this->question($id);
        }
    }

}

?>