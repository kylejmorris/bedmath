<?php

class Mod_Redeem_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->points = new Points();
        $this->ban = new Ban();
        $this->question = new Question();
        $this->answer = new Answer();
        $this->email = new Email();
    }

    public function getRedeemSummary() {
        $summary = array('total_requests' => '', 'total_paid', 'total_accepted' => '', 'total_pending' => '', 'total_denied'=>'', 'cash_accepted', 'cash_paid' => '', 'cash_pending' => '');
        $summary['total_requests'] = $this->points->getRedeemCount(null);
        $summary['total_paid'] = $this->points->getRedeemCount('paid');
        $summary['total_accepted'] = $this->points->getRedeemCount('accepted');
        $summary['total_pending'] = $this->points->getRedeemCount('pending');
        $summary['total_denied'] = $this->points->getRedeemCount('denied');
        $summary['cash_paid'] = $this->points->redeemCashSum('paid');
        $summary['cash_accepted'] = $this->points->redeemCashSum('accepted');
        $summary['cash_pending'] = $this->points->redeemCashSum('pending');
        return $summary;
    }

    public function getPending($page, $limit) {
        $requests = $this->points->getRedeemRequests('pending', $page, $limit);
        for ($c = 0; $c < sizeof($requests); $c++) {
            array_push($requests[$c], 'username');
            $requests[$c]['username'] = $this->user->getNameFromId($requests[$c]['user_id']);
        }
        return $requests;
    }
    
    public function getDenied($page, $limit) {
        $requests = $this->points->getRedeemRequests('denied', $page, $limit);
        for ($c = 0; $c < sizeof($requests); $c++) {
            array_push($requests[$c], 'username');
            $requests[$c]['username'] = $this->user->getNameFromId($requests[$c]['user_id']);
        }
        return $requests;
    }
    
    public function getAccepted($page, $limit) {
        $requests = $this->points->getRedeemRequests('accepted', $page, $limit);
        for ($c = 0; $c < sizeof($requests); $c++) {
            array_push($requests[$c], 'username');
            $requests[$c]['username'] = $this->user->getNameFromId($requests[$c]['user_id']);
        }
        return $requests;
    }
    
    public function getPaid($page, $limit) {
        $requests = $this->points->getRedeemRequests('paid', $page, $limit);
        for ($c = 0; $c < sizeof($requests); $c++) {
            array_push($requests[$c], 'username');
            $requests[$c]['username'] = $this->user->getNameFromId($requests[$c]['user_id']);
        }
        return $requests;
    }

    public function getRedeemReview($id) {
        $details = $this->points->getRedeemRequest($id);
        if ($this->user->isBanned($details['user_id'])) {
            $details['is_banned'] = '<b>YES</b>';
        } else {
            $details['is_banned'] = 'No';
        }
        if (sizeof($this->ban->getBanHistory(1, 10, null, $details['user_id']))>0) {
            $details['has_been_banned'] = '<b>YES</b>';
        } else {
            $details['has_been_banned'] = 'No';
        }
        $details['total_questions'] = $this->question->getQuestionCount(array('asked_by'=>$details['user_id']));
        $details['answer_count'] = $this->answer->getAnswerCount(array('user'=>$details['user_id']));
        if($details['answer_count']==0) {
            $details['answer_count'] = '<b>'.$details['answer_count'].'</b>';
        }
        $details['activated'] = $this->user->isActivated($details['user_id']);
        if(!$details['activated']) {
            $details['activated'] = '<b>Not Activated</b>';
        } else {
            $details['activated'] = 'Activated';
        }
        return $details;
    }

    /**
     * Send email to user notifying them that they have been accepted and will receive payment shortly. Also update database info.
     * @param type $id
     */
    public function reviewAccepted($id) {
        $redeemRequest = $this->points->getRedeemRequest($id);
        $userDetail = $this->user->getDetailFromId($redeemRequest['user_id']);
        $this->email->generateDefaultMail(4, $userDetail['user_id']);
        $this->email->sendMail(array($userDetail['email']));
        $this->points->editRedeemStatus($id, 'accepted');
    }
    
    /**
     * Send email to user notifying them that they have been denied and will need to fix the errors.
     * @param type $id
     */
    public function reviewDenied($id) {
        $redeemRequest = $this->points->getRedeemRequest($id);
        $userDetail = $this->user->getDetailFromId($redeemRequest['user_id']);
        $this->email->generateDefaultMail(5, $userDetail['user_id']);
        $this->email->sendMail(array($userDetail['email']));
        $this->points->editRedeemStatus($id, 'denied');
    }
    
    
    public function runPaid($id) {
        $this->points->editRedeemStatus($id, 'paid');
    }
}

?>