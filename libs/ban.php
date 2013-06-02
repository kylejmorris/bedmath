<?php

/**
 * Manages bans on site users. Provides methods that allow further manipulation of bans.
 * Ban data is located in the g0g1_bans table of database.
 */
Class Ban extends Database {

    public function __construct() {
        $this->database = new Database();
        $this->user = new User();
    }

    /**
     * Create a new ban on user_id
     * @param $userId the id of user to ban
     * @param $length length of ban, as string data. This will be converted to a timestamp accordingly.
     * @param $comments notes regarding the ban, displayed to user upon receiving ban. 
     */
    public function newBan($userId = null, $length = null, $comments = null) {
        switch ($length) {
            case 'minute': $length = 60;
                break;
            case 'hour': $length = 60 * 60;
                break;
            case '1day': $length = 60 * 60 * 24;
                break;
            case '3days': $length = 60 * 60 * 24 * 3;
                break;
            case '7days': $length = 60 * 60 * 24 * 7;
                break;
            case '14days': $length = 60 * 60 * 24 * 14;
                break;
            case '1month': $length = 60 * 60 * 24 * 31;
                break;
            case '3months': $length = 60 * 60 * 24 * 30 * 3;
                break;
            case '6months': $length = 60 * 60 * 24 * 30 * 6;
                break;
            case '1year': $length = 60 * 60 * 24 * 365;
                break;
            case 'forever': $length = 60 * 60 * 24 * 365 * 50;
                break;
            default: $length = 60 * 60 * 24;
        }
        $createdBy = $this->user->getUserId();
        $createdTime = time();
        $expires = time() + $length;
        $columns = array('user_id' => $userId, 'created_by' => $createdBy, 'created_time' => $createdTime, 'expires' => $expires, 'comments' => $comments);
        $this->database->insertRow('g0g1_bans', $columns);
        $this->database->update('g0g1_users', array('user_level' => 0), array('user_id' => $userId));
    }

    public function getBanDetails($userId) {
        $rows = $this->database->getRows('g0g1_bans', array('id', 'user_id', 'created_by', 'created_time', 'expires', 'comments'), array('user_id' => $userId), 'id');
        return $rows;
    }

    /**
     * Determine if user ban has expired.
     * @param $userId The id of user to determine ban expiration on. 
     * Note: This will check the most recent ban, in case the user has been banned before. Only the most recently issued ban shall be analysed
     * @return boolean true = expired, false = not expired
     */
    public function banExpired($userId) {
        $query = "SELECT expires FROM g0g1_bans WHERE user_id='$userId'";
        $row = $this->database->query($query);
        $results = $row->fetch();
        $currentTime = time();
        if ($results[0] < $currentTime) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Unban specified user by changing user level and adjusting logs
     * @param $userId the id of user to unban
     */
    public function unban($userId) {
        $this->database->update('g0g1_user', array('user_level' => 2), array('user_id' => $userId));
    }

    public function getBanCount() {
        return $this->database->getCount('g0g1_bans', array());
    }

    public function getBanHistory($page, $count, $since = null, $userId = null) {
        $start = ($page * $count) - $count;
        if ($since != null) {
            switch ($since) {
                case 'day': $since = 86400;
                    break;
                case 'week': $since = 86400 * 7;
                    break;
                case 'month': $since = (86400 * 365) / 12;
                    break;
                case 'year': $since = 86400 * 365;
                    break;
                default: $since = 86400 * 7;
            }
        }
        $results = $this->database->getRows('g0g1_bans', array('id', 'user_id', 'created_by', 'created_time', 'expires', 'comments'), array('user_id' => $userId, 'created_time' => array($since, '>')), 'id');
        for ($c = 0; $c < sizeof($results); $c++) {
            $results[$c]['user_id'] = $this->user->getNameFromId($results[$c]['user_id']);
            $results[$c]['created_time'] = date("M d, Y h:i:s A", $results[$c]['created_time']);
            $results[$c]['expires'] = date("M d, Y h:i:s A", $results[$c]['expires']);
        }
        return $results;
    }

}

?>