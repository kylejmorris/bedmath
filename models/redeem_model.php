<?php

class Redeem_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->question = new Question();
        $this->answer = new Answer();
    }

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
        if (!$details['activated']) {
            $details['activated'] = '<font color="red"><b>Your account has not been activated via email yet.</b></font>';
        } else {
            $details['activated'] = '<font color="green"><b>Your account is activated.</b></font>';
        }
        return $details;
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