<?php

class Login_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * Sent from login controller, processes form data from login form. 
     * @param $formData array containing data retrieved via form class
     * @return User id if account information is correct
     */
    function run($formData = array()) {
        $username = $formData['username']; //Extracting data from form Array
        $password = $formData['password'];
        $query = "SELECT user_id from g0g1_users WHERE username ='$username' AND password = '$password'";
        $row = $this->database->query($query);
        $result = $row->fetchColumn();
        return $result;
    }

}

?>