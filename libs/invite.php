<?php

/**
 * Manages invitations/referral data associated with the site. 
 */
Class Invite {
    protected $database;
    public function __construct($db) {
        if($db==null) {
            $this->database = new Database();
        } else {
            $this->database = $db;
        }
    }
    
    /**
     * Returns a count representing how many users have joined to site from being invited by a specific user. 
     * @param $userId the id of the user to check for invite count
     */
    public function getInviteCount($userId) {
        $count = $this->database->getRow('g0g1_users', array('invites'), array('user_id'=>$userId));
        return $count[0];
    }
    
    /**
     * Returns referral usernames of those who were invited by a specific user.
     * @param $userId the id of user who is inviting.
     * @param $time timestamp regarding earliest time a user joined to be included in referral list.
     */
    public function getReferrals($userId, $time, $page, $limit) {
        $referrals = $this->database->getByPage('g0g1_users', array('user_id', 'username', 'join_date'), array('invited_by'=>$userId, 'join_date'=>array($time, '>')), 'join_date', $page, $limit);
        return $referrals;
    }
    
    /**
     * Sends out email invitation
     */
    public function sendEmailInvite($sender, $receivers) {
        
    }
}
?>
