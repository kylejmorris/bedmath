<?php

/**
 * Displays list of recently asked questions, prompting users to answer.
 */
class Questions extends Controller {

    public function __construct() {
        parent::__construct();
        $this->question = new Question();
        $this->pagination = new Pagination();
        $this->category = new Category();
    }

    public function index() {
        $this->view(1);
    }

    /**
     * Main view listing recently asked questions. Further sorting may be done by the user.
     * @param $page current page user is viewing
     * @param $topic the id of topic being searched
     * @param $bid the minimal bid to load for questions.
     */
    public function view($page, $topic, $bid) {
        $limit = 4;
        if (empty($page)) {
            $page = 1;
        }
        if (empty($topic) || $topic == 0) {
            $topic = null;
        } //Giving topic the optional value of 0 to represent 'all topics', since passing a null value through url is messy
        if (empty($bid) || $bid < 10) {
            $bid = 10;
        } //Minimal bids to display are 10, since you can't bid less.
        $where = array('topic' => $topic, 'bid' => array($bid, '>=')); //Where conditions for gathering question count, used for loading pagination accurately.
        $qCount = $this->question->getQuestionCount($where); // Returns number of questions in which can be displayed on page.
        $questions = $this->model->view($page, $where, $limit);
        $this->view->pagination = $this->pagination->getPageList($page, $limit, $qCount);
        $this->view->topic = $topic; //Current topic id
        $this->view->page = $page; //Current page, used for sorting.
        $this->view->bid = $bid; //Minimal bid to accept, used for sorting
        $this->view->topics = $this->category->getCategories();
        $this->view->questions = $questions; //Question data
        $this->view->available = $qCount; //Number of questions to display in statistics module as being 'available'
        $this->view->render('questions/view');
    }
    
    public function highest($page, $topic) {
        $limit = 4;
        if (empty($page)) {
            $page = 1;
        }
        if (empty($topic) || $topic == 0) {
            $topic = null;
        }
        //Giving topic the optional value of 0 to represent 'all topics', since passing a null value through url is messy
        $where = array('topic' => $topic);
        $qCount = $this->question->getQuestionCount($where); // Returns number of questions in which can be displayed on page.
        $questions = $this->model->highest($page, $where, $limit);
        $this->view->pagination = $this->pagination->getPageList($page, $limit, $qCount);
        $this->view->topic = $topic; //Current topic id
        $this->view->page = $page; //Current page, used for sorting.
        $this->view->topics = $this->category->getCategories();
        $this->view->questions = $questions; //Question data
        $this->view->available = $qCount; //Number of questions to display in statistics module as being 'available'
        $this->view->render('questions/highest');
    }
    
    public function unanswered($page, $topic) {
        $limit = 4;
        if (empty($page)) {
            $page = 1;
        }
        if (empty($topic) || $topic == 0) {
            $topic = null;
        }
        //Giving topic the optional value of 0 to represent 'all topics', since passing a null value through url is messy
        $where = array('topic' => $topic, 'unanswered'=>1);
        $qCount = $this->question->getUnansweredCount(null, $topic, 1, $limit); // Returns number of questions in which can be displayed on page.
        $questions = $this->model->unanswered($page, $topic, $limit);
        $this->view->pagination = $this->pagination->getPageList($page, $limit, $qCount);
        $this->view->topic = $topic; //Current topic id
        $this->view->page = $page; //Current page, used for sorting.
        $this->view->topics = $this->category->getCategories();
        $this->view->questions = $questions; //Question data
        $this->view->available = $qCount; //Number of questions to display in statistics module as being 'available'
        $this->view->render('questions/unanswered');
    }

}

?>
