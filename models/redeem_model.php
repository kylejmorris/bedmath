<?php

class Redeem_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Variety of checks generating notifications for the user regarding their account standing. 
     * This will let them know if their redeem request will be accepted or not, and with what overall chance. 
     */
    public function getChecks() {
        $details = array();
        $userId = $this->user->getUserId();
        $answerCount = $this->answer->getAnswerCount(array('user'=>$userId));
        if ($this->user->isBanned($userId)) {
            $details['is_banned'] = '<font color="red"><b>You are banned.</b></font>';
        } else {
            $details['is_banned'] = '<font color="green"><b>You are not currently banned.</b></font>';
        }
        if (sizeof($this->ban->getBanHistory(1, 10, null, $details['user_id'])) > 0) {
            $details['has_been_banned'] = '<font color="orange"><b>You have been banned before.</b></font>';
        } else {
            $details['has_been_banned'] = '<font color="green"><b>Never been banned before</b></font>';
        }
        if ($answerCount == 0) {
            $details['answer_count'] = '<font color="orange"><b>No answers posted.</b></font>';
        } else {
            $details['answer_count'] = '<font color="green"><b>At least 1 answer posted.</b></font>';
        }
        if ($this->user->isActivated($userId)!=true) {
            $details['activated'] = '<font color="red"><b>Your account has not been activated via email yet.</b></font>';
        } else {
            $details['activated'] = '<font color="green"><b>Your account is activated.</b></font>';
        }
        if($this->points->hasPendingRedeemRequest($userId)) {
            $details['already_pending'] = '<font color="red"><b>You already have a redeem request pending.</b></font>';
        } else {
            $details['already_pending'] = '<font color="green"><b>No current requests pending.</b></font>';
        }
        return $details;
    }
    
    /**
     * Runs through checks another time, but this time only critical ones. If any of these checks are not met,
     *  the user cannot even send the redeem request as it wastes staff time. 
     */
    public function confirmChecks() {
        $userId = $this->user->getUserId();
        if ($this->user->isBanned($userId)) {
            $GLOBALS['error']->addError('user', 'You are banned and may not send redeem requests at this time, how the heck are you even on this page?');
            return false;
        }
        if ($this->user->isActivated($userId)!=true) {
            $GLOBALS['error']->addError('user', 'You must be activated to send a redeem request.');
            return false;
        }
        if($this->points->hasPendingRedeemRequest($userId)) {
            $GLOBALS['error']->addError('points', 'You already have a pending redeem request in the system.');
            return false;
            
        }
        return true;
    }

    public function runRedeem($formData, $userId) {
        $request_code = "";
        for ($c = 0; $c < 32; $c++) {
            $request_code.=rand(0, 9);
        }
        $columns = array('request_code' => (int) $request_code, 'user_id' => $userId, 'amount' => $formData['redeem_amount'], 'time' => time(), 'status' => 'pending');
        $this->database->insertRow('g0g1_redeem', $columns);
    }

}

?>