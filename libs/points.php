<?php

/**
 * Extends database and is used to handle a points system/virtual currency. 
 * Supplies functionality for adding removing, locating, and manipulating the 
 * specified point-based database tables.
 */
class Points extends Database {

    /**
     * Creates database object
     */
    function __construct() {
        $this->database = new Database();
        $this->user = new User();
    }

    /**
     * Gets sum of points balance among all site users
     * @return Total points of all site users
     */
    public function getCommunityPoints() {
        $sum = $this->database->getRowSum('g0g1_users', 'points');
        return $sum;
    }

    /**
     * Gets the user with most points in community
     * @return richest user
     */
    public function getRichestUser() {
        $query = "SELECT MAX(points) AS maxPoints FROM g0g1_users";
        $row = $this->database->query($query);
        $result = $row->fetch();
        $user = $this->database->getRow('g0g1_users', array('username'), array('points' => $result['maxPoints']));
        return $user['username'];
    }

    /**
     * Checks database row in which contains $userId, then grabs the points value associated. 
     * @param $userId The id of User in which to get points data from 
     */
    public function getPoints($userId) {
        $result = $this->database->getRow('g0g1_users', array('points'), array('user_id' => $userId));
        return $result['points'];
    }

    //Converts int value of transaction type, by returning string value associated in g0g1_points table
    public function typeIdToName($id) {
        $userData = $this->database->getRow('g0g1_points', array('name'), array('type_id' => $id));
        return $userData['name'];
    }

    //Returns amount of points earned since a specified date
    public function pointsEarned($userId, $since) {
        switch ($since) { //running through string value of $since, determining the representation it holds as a timestamp
            case "day":
                $since = 86400;
                break;
            case "week":
                $since = 86400 * 7;
                break;
            case "month":
                $since = 86400 * 31;
                break;
            case "year":
                $since = 86400 * 365;
                break;
            case "all_time":
                $since = 9999999999;
                break;
            default: $since = 9999999999;
                break;
        }
        $since = time() - $since;
        $sum = $this->database->getRowSum('g0g1_points_log', 'points', array('subject' => $userId, 'time' => array($since, '>')));
        if ($sum == null) {
            $sum = 0; //Setting default value to 0 if no points were earned during the specified time
        }
        return $sum;
    }

    /**
     * Adds points to the user specified
     * @param $subject The user in which will gain points
     * @param $amount Amount of points to give user
     * @param $type This is representing the transfer type (as you can see within database table (g0g1_points). By default it will be set as 1 which means (rewarded points from system). 
     * @param $object The user id of who sent the points, this is the case within a donation for example. Default value is 1, which means the system sent points. 
     */
    public function addPoints($subject = 1, $amount = 0, $type = 1, $object = 0) { //Defaults are set based on what is supplied. 
        $currentPoints = $this->getPoints($subject); //Get current points of user. 
        $result = $currentPoints + $amount; //Calculate resulting points after adding amount
        $this->database->update('g0g1_users', array('points' => $result), array('user_id' => $subject));
        $this->logPoints($subject, $amount, $type, $object);
    }

    /**
     * Removes points from the user specified
     * @param $subject The user id of whom will loose points
     * @param $amount The amount of points to remove from user
     * @param $type This is representing the transfer type (as you can see within database table (g0g1_points). By default it will be set as 2 which means (points removed by system).
     * @param $object If for any reason this transaction was executed by another user, their username goes here. Such as a refund for example.
     */
    public function removePoints($subject = 1, $amount = 1, $type = 2, $object = 0) { //Default values, type is system deduction unless otherwise specified
        $currentPoints = $this->getPoints($subject);
        $result = $currentPoints - $amount;
        $this->database->update('g0g1_users', array('points' => $result), array('user_id' => $subject));
        $this->logPoints($subject, -$amount, $type, $object);
    }

    /**
     * Records points transaction in database.
     * @param $receiver This is ID the user in which was directly affected by the transaction. Such as the user who had points removed from them, or the user who was donated points. This will be set as ID 1 (system) by default, in case nothing else was specified
     * @param $amount The amount of points within transaction
     * @param $type The ID representing the type of transaction. Refer to database for information on these types. An example would be ID 7 = Donation sent
     * @param $sender The user who executed the original transaction. By default this will be set as system(id1), in case another user didn't trigger the event.
     */
    public function logPoints($subject = 1, $amount, $type = 1, $object) { //sender and receiver are optional depending on transaction type
        $time = time();
        $columns = array('transaction_type' => $type, 'subject' => $subject, 'object' => $object, 'points' => $amount, 'time' => time());
        $this->database->insertRow('g0g1_points_log', $columns);
    }

    /**
     * Calculates tax amount and removes such an amount from points transaction. 
     * For example; upon donation, 10% of points are put into fee
     * @param $amount How many points in transaction
     * @param $fee A deciminal value representing the tax. Example: 0.10 = 10%
     */
    public function deductTaxFee($amount, $fee) {
        $fee /= 100; //Making the fee a % value
        $feeAmount = $amount * $fee; //Getting exact fee value. 
        $newAmount = $amount - $feeAmount; //Transfer amount after fee has been deducted
        return $newAmount;
    }

    /**
     * Returns point transactions data based on specific information.
     * @param $page the page in which is being viewed for transactions
     * @param $count the maximum amount of records to load
     * @param $type specific type of transactions to gather
     * @param $time Earliest date to get transactions
     * @param $userId ID of user to get transactions from 
     */
    public function getTransactions($page = 1, $count = 10, $type = null, $time = 'day', $userId = null) { //$time, is the earliest time to get points from, represented as time stamp
        if (!is_numeric($type)) {
            $type = null;
        }
        switch ($time) { //running through string value of $since, determining the representation it holds as a timestamp
            case "day":
                $time = 86400;
                break;
            case "week":
                $time = 86400 * 7;
                break;
            case "month":
                $time = 86400 * 31;
                break;
            case "year":
                $time = 86400 * 365;
                break;
            case "all_time":
                $time = 9999999999;
                break;
            default: $time = 9999999999;
                break;
        }
        $start = ($page * $count) - $count; //Determining which user to start gathering from, in terms of ID.
        $timeSince = time() - $time; //Getting time to look for transactions from. By default, $time is set to transactions for past day
        $where = array('subject' => $userId, 'transaction_type' => $type, 'time' => array($timeSince, '>'));
        $columns = array('transaction_id', 'transaction_type', 'subject', 'object', 'points', 'time');
        $result = $this->database->getRows('g0g1_points_log', $columns, $where, 'time');
        for ($c = 0; $c < sizeof($result); $c++) {
            $result[$c]['object'] = $this->user->getNameFromId($result[$c]['object']);
            $result[$c]['subject'] = $this->user->getNameFromId($result[$c]['subject']);
            if (empty($result[$c]['object'])) {
                $result[$c]['object'] = 'system';
            }

            if (empty($result[$c]['subject'])) {
                $result[$c]['subject'] = 'system';
            }
        }
        return $result;
    }

    //Returns number of transactions
    public function getTransactionCount() {
        return $this->database->getCount('g0g1_points_log', array());
    }

    //Returns data on transaction type based on the transaction ID given
    public function getTransactionTypes($id = null) {
        return $this->database->getRows('g0g1_points', array('id', 'type_id', 'name', 'description'), array('type_id' => $id), 'id');
    }

    public function getRedeemRequests() {
        
    }

}

?>