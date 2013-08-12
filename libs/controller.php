<?php

/**
 * Main controller used in MVC. The base of communication between view and model. 
 * @author Kyle Morris
 */
class Controller {

    /**
     * The main database object, in which is fed into all sub-objects used by controllers. 
     * This will prevent the excessive use of database connections, as all objects share one!
     */
    protected $database;
    protected $answer;
    protected $category;
    protected $ban;
    protected $email;
    protected $form;
    protected $image;
    protected $invite;
    //Notification object, for updating users when activity is relevant to them. 
    protected $notification;
    
    protected $pagination;
    protected $pass;
    
    protected $points;
    protected $question;
    protected $reply;
    protected $report;
    
    protected $reputation;
    protected $session;
    
    protected $user;
    public $view;

    function __construct() {
        $this->database = new Database();
        $this->loadObjects();
        $this->error = new Error();
        $this->view = new View();
        //$this->user = new User();  
        Session::start();
        $this->checkUser();
        
    }

    /**
     * Note: Some objects are not included in this list, such as Image.
     * Objects like Image are not required, as they need to be created separate from eachother. 
     * When creating a new object like Image within a controller/model, simply use $image = new Image($this->database); 
     * and this will have the same result.
     */
    private function loadObjects() {
        $this->answer = new Answer($this->database);
        $this->category = new Category($this->database);
        $this->ban = new Ban($this->database);
        $this->email = new Email($this->database);
        $this->form = new Form(null, $this->database);
        //$this->image = new Image($this->database); Image is not required, as a 
        $this->invite = new Invite($this->database);
        $this->notification = new Notification($this->database);
        $this->pagination = new Pagination($this->database);
        $this->pass = new Pass($this->database);
        $this->points = new Points($this->database);
        $this->question = new Question($this->database);
        $this->reply = new Reply($this->database);
        $this->report = new Report($this->database);
        $this->reputation = new Reputation($this->database);
        $this->session = new Session($this->database);
        $this->user = new User($this->database);
    }

    /**
     * Used to analyse current user on site and determine if they are logged in, shall remain logged in, etc. . . .
     */
    public function checkUser() {
        $user = new User();
        if ($user->isLoggedIn()) {
            $sessionData = Session::getSessionData(Session::getId());
            if (!Session::isExpired(Session::getId())) {
                Session::rebuildSession($sessionData['id']);
            } else {
                $user->logout();
            }
        }
    }

    /**
     * @description Loads a model by calling the name following by _model.php being concatenated. This is called by default within the index.php file of framework and does not hold much further use. 
     * @param $name Name of model to load.
     */
    public function loadModel($appType, $name) {
        $path = $appType . 'models/' . $name . '_model.php';
        if (file_exists($path)) {
            require $path;
            $modelName = $name . '_model';
            $this->model = new $modelName();
        } else {
            //echo 'Could not locate model';
        }
    }

}

?>