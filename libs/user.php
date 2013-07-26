<?php

/**
 * Handles user information with all kinds of functionality. 
 */
class User {

    public $orderTypes = array('user_id', 'username', 'points', 'join_date', 'invites', 'blocked');

    /**
     * Creates database object as a link from this class
     */
    function __construct() {
        $this->database = new Database(); //Create database object for this class. Should have been able to instantiate it only once from the loader.php file. I will try to make this stuff more dynamic in the future. 
    }

    /**
     * Returns number of users in database, just for quick access to info to display on stat pages.
     */
    public function userCount() {
        $query = "SELECT COUNT(*) FROM g0g1_users";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result[0];
    }
    
    public function isLoggedIn() {
        if(Session::sessionInDb(Session::getId())==true) {
               return true;
        } else {
                return false;
        }
    }

    /**
     * Gets full list of users and their data, returns as multidimentional array
     * Note: Has parameters that deal with pagination. Can be changed to specify how many users to return
     * @param $page The page number being viewed, such as on the memberlist. 
     * Note: The page may not be required if method is being used purely in backend
     * if this is the case then just set $page to 1, and the user rows will begin from beginning. 
     * @param $count How many users to display on page. Default is 1
     * @param $order The order in which information is loaded. Default is by user_id
     */
    public function getUsers($page = 1, $count = 10, $order = 'user_id') {
        if (!in_array($order, $this->orderTypes)) {
            $order = "user_id";
        }
        $start = ($page * $count) - $count; //Determining which user to start gathering from, in terms of ID.
        $query = "SELECT * FROM g0g1_users ORDER BY $order ASC LIMIT $start,$count"; //Getting all users
        $row = $this->database->query($query);
        $result = $row->fetchAll();
        for ($c = 0; $c < sizeof($result); $c++) {
            $result[$c]['user_level'] = $this->levelToText($result[$c]['user_level']); //Changing the value of user_level to the string equivilent 
        }
        return $result;
    }

    /**
     * Gets user level associated with user id. Returns integer value from database
     * @param $userId The userId in which to get user level from
     */
    public function getUserLevel($userId) {
        if ($userId != NULL) {
            $query = "SELECT user_level FROM g0g1_users WHERE user_id = '$userId'";
            $row = $this->database->query($query);
            $result = $row->fetchColumn();
        } else {
            $result = 0;
        }
        return $result;
    }

    public function login($userId) {
        Session::create('loggedin', true, $userId);
    }
    
    public function logout($userId) {
        Session::kill(Session::getId());
    }

    /**
     * Returns ID of user who is currently logged into site. This is by checking value of Session::userId
     * If user id is not set, it shall simply return NULL
     */
    public function getUserId() {
        if ($this->isLoggedIn()) {
            $userSession = $this->database->getRow('g0g1_sessions', array('user_id'), array('session_id'=>Session::getId()));
            return $userSession['user_id'];
        } else {
            $userId = NULL;
        }
        return $userId;
    }

    /**
     * Returns string data of username based on the user id supplied. This is by going into g0g1_users table of database
     * @param $userId The value associated with username to get
     */
    public function getNameFromId($userId) {
        $query = "SELECT username FROM g0g1_users WHERE user_id = '$userId'";
        $row = $this->database->query($query);
        $result = $row->fetchColumn();
        return $result;
    }

    /**
     * Returns array containing user details. This is by checking for records associated with specified user id. 
     * @param $userId The id of user to return details from 
     */
    public function getDetailFromId($userId) {
        $query = "SELECT user_id, username, password, points, join_date, email, activate_code, activated, user_level, avatar_id FROM g0g1_users WHERE user_id = '$userId'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result;
    }

    //OLD: JUST USE getDetailFromId
    public function getEmailFromid($userId) {
        $query = "SELECT email FROM g0g1_users WHERE user_id = '$userId'";
        $row = $this->database->query($query);
        $result = $row->fetchColumn();
        return $result;
    }

    public function setNewPass($userId, $pass) {
        $query = "UPDATE g0g1_users SET password=:password WHERE user_id='$userId'";
        $stmt = $this->database->prepare($query);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();
    }

    /**
     * Locates the associated level title by supplying numeric level value. Returns string version of user level 
     * @param $level The integer representing level of user
     * Example: $level = 2; this would return registered, or what ever title is associated. 
     */
    public function levelToText($level) {
        $query = "SELECT title FROM g0g1_user_levels WHERE level = '$level'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result['title']; //Send back text value 
    }

    /**
     * Takes string version of users name and locates the user id associated with it
     * @param $username The username to locate user id from
     */
    public function nameToId($username) {
        $query = "SELECT user_id FROM g0g1_users WHERE username = '$username'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result['user_id'];
    }

    /**
     * Conditional statement checking if user information exists based on the user id supplied
     * @param $userId - the id to check for existence
     */
    public function exists($userId) {
        $query = "SELECT user_id FROM g0g1_users WHERE user_id = '$userId'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }

    public function usernameExists($username) {
        $where = array('username' => $username);
        $count = $this->database->getCount('g0g1_users', $where);
        if ($count != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function setActivationCode($userId) {
        $code = md5(rand(0, 9999999));
        $query = "UPDATE g0g1_users SET activate_code='$code' WHERE user_id='$userId'";
        $this->database->query($query);
    }

    public function checkActivation($userId, $code) {
        $query = "SELECT activate_code FROM g0g1_users WHERE user_id='$userId'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        if ($result[0] != "null") {
            if ($code == $result[0]) {
                $query = "UPDATE g0g1_users SET activate_code='null' WHERE user_id='$userId'";
                $this->database->query($query);
                return true;
            } else {
                return false;
            }
        } else {
            echo 'Error: User does not need activation';
        }
    }

    /**
     * Updates user table to increase invite count upon succesfull invite
     * @param $userId the id of user to credit invite
     */
    public function recordInvite($userId) {
        $query = "UPDATE g0g1_users SET invites=invites+1 WHERE user_id = '$userId'";
        $this->database->query($query);
    }

    /**
     * Determine if user is banned by checking user level
     * @param $userId the id of user to check
     */
    public function isBanned($userId) {
        if ($this->getUserLevel($userId) == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Activation requires the confirmation of ones email after signing up an account. Certain site features require activation.
     * @param type $userId the user id to check activation.
     */
    public function isActivated($userId) {
        $activation = $this->database->getRow('g0g1_users', array('activated'), array('user_id'=>$userId));
        if($activation[0]==true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Searches database for users 
     * @param $query the search text
     * @param $page the page of results to load
     * @param $limit the maximum amount of results to return.
     */
    public function searchUsers($query, $page, $limit) {
        $columns = array('user_id', 'username', 'join_date', 'points', 'user_level');
        $match = array('username');
        $result = $this->database->search('g0g1_users', $columns, $match, $query, 'boolean', $page, $limit);
        return $result;
    }

}

?>