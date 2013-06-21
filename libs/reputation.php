<?php

/**
 * Manages reputation of users on the site. Reputation allows the customer to find the most reliable source of support possible, in a short time.
 * Note: Reputation is not the final decision in a users success, but rather a tool used to help build them through experience on the site.
 */
class Reputation {

    public function __construct() {
        $this->database = new Database();
        $this->category = new Category();
    }

    /**
     * Returns logged reputation history
     * @param $userId the id of user to get reputation from
     * @param $topic the topic to select log from, null if any topic is alright.
     * @param $page the current page being viewed on userend
     * @param $limit max amount of records to load per page.
     */
    public function getRepLog($userId, $topic, $page, $limit) {
        $columns = array('id', 'rule', 'topic', 'subject', 'object', 'time', 'amount', 'status');
        $log = $this->database->getByPage('g0g1_rep_log', $columns, array('subject'=>$userId, 'topic'=>$topic), 'time', $page, $limit);
        return $log;
        
    }
    
    /**
     * Returns count, of how many log entries fit the according description.
     * @param $userId the id of user/subject in log entry
     * @param $topic the topic reputation was earned within.
     */
    public function getLogCount($userId, $topic) {
        $count = $this->database->getCount('g0g1_rep_log', array('subject'=>$userId, 'topic'=>$topic));
        return $count;
        
    }
    /**
     * Get the amount of reputation a user has.
     * @param $id the id of user to get reputation from.
     * @param $topic the topic to get reputation amount from.
     */
    public function getUserRep($id, $topic) {
        $where = array('subject' => $id, 'topic' => $topic);
        $rep = $this->database->getRowSum('g0g1_rep_log', 'amount', $where);
        if ($rep == null) {
            $rep = 0;
        }
        return $rep;
    }

    /**
     * Increase a users reputation and then log action in database.
     * @param $subject the user to increase reputation
     * @param $amount numerical value representing increase.
     * @param $type the rule associated with reputation reason.
     * @param $topic the mathematical topic rep was earned in.
     * @param $object the user who triggered this event, such as user who asked math question
     */
    public function addRep($subject = 1, $amount, $type, $topic, $object = 0) {
        $time = time();
        $columns = array('rule' => $type, 'topic' => $topic, 'subject' => $subject, 'object' => $object, 'time' => $time, 'amount' => $amount, 'status' => 1);
        $this->database->insertRow('g0g1_rep_log', $columns);
    }

    /**
     * Returns ordered list of users reputation and the topic it is assocated with, greatest to least value. 
     * @param $limit the maximum amount of topics to return.
     * @return Associative array containing topic name and reputation within it. Topic = array[0], value = array[1]
     */
    public function getTopicsByRep($userId, $limit) {
        $topicCount = $this->category->getNumberOfCategories();
        if($limit>$topicCount) {
            $limit=$topicCount;
        }
        $topics = $this->category->getCategories();
        $rep = array();
        for($c=0; $c<$limit; $c++) {
            if($this->getUserRep($userId, $topics[$c]['cat_id'])>0) {
                $rep[$c] = array($topics[$c]['name'], $this->getUserRep($userId, $topics[$c]['cat_id']));
            }
        }
        return array_reverse($rep);
    }
    /**
     * Decrease a users reputation and then log action in database.
     * @param $user the user to decrease reputation
     * @param $amount numerical value representing decrease.
     */
    public function removeRep($user, $amount) {
        
    }

}

?>