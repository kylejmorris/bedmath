<?php

/**
 * Main model used in MVC. 
 * The base of communication between controller and database. 
 * Controls business logic and parents individual component models that extend to it. 
 */
class Model {

    /**
     * Object of database allowing access to mysql and extension to PDO class
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

    /**
     * Creates new database object
     */
    public function __construct() {
        $this->database = new Database();
        $this->loadObjects();
    }
    
    /**
     * Load all objects for models to use, this allows fully shared database object instead of a ridiculous amount of connections simultaneously.
     */
    private function loadObjects() {
        $this->answer = new Answer($this->database);
        $this->category = new Category($this->database);
        $this->ban = new Ban($this->database);
        $this->email = new Email($this->database);
        $this->form = new Form(null, $this->database);
        $this->image = new Image($this->database);
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

}

?>