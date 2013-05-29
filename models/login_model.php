<?php

class Login_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->pass = new Pass();
    }

    /**
     * Sent from login controller, processes form data from login form. 
     * @param $formData array containing data retrieved via form class
     * @return User id if account information is correct
     */
    function run($formData = array()) {
        $username = $formData['username']; //Extracting data from form Array
        $password = $formData['password'];
        $userId = $this->user->nameToId($username);
        if($this->pass->isValid($userId, $password)) {
            return $userId;
        }
        return false;
    }

}

?>