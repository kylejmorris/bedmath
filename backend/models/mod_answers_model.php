<?php

class Mod_Answers_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getSummary() {
        $summary = array('total_answers' => '', 'posted_today' => '');
        $summary['total_answers'] = $this->answer->getAnswerCount(array());
        $time = time(); //Timestamp for certain data needs.
        $summary['posted_today'] = $this->answer->getAnswerCount(array('time'=>array($time, '>')));
        return $summary;
    }

    public function getHistory($page, $user) {
        $answers = $this->answer->getAnswers(array('user' => $user), 'time', $page, 25);
        for ($c = 0; $c < sizeof($answers); $c++) {
            array_push($answers[$c], 'username');
            $answers[$c]['username'] = $this->user->getNameFromId($answers[$c]['user']);
            if($answers[$c]['published']==true) {
                $answers[$c]['published'] = 'Yes';
            } else {
                $answers[$c]['published'] = 'No';
            }
            if($answers[$c]['activated']==true) {
                $answers[$c]['activated'] = 'Yes';
            } else {
                $answers[$c]['activated'] = 'No';
            }
            if($answers[$c]['accepted']==true) {
                $answers[$c]['accepted'] = 'Yes';
            } else {
                $answers[$c]['accepted'] = 'No';
            }
        }
        return $answers;
    }

    public function getAnswerReviewSummary($id, $version) {
        $cVersion = $this->answer->getAnswerVersion($id);
        if ($version == null || $version==$cVersion) { //If null or set as current version.
            $summary = $this->answer->getAnswerById($id);
            array_push($summary, 'username'); //Full username instead of just user_id.
            $summary['username'] = $this->user->getNameFromId($summary['user']);
            $summary['version'] = $this->answer->getAnswerVersion($id);
            print_r($summary);
        } else {
            $summary = $this->answer->getAnswerByVersion($id, $version);
            array_push($summary, 'version'); //Get current question version.
            array_push($summary, 'username'); //Full username instead of just user_id.
            array_push($summary, 'edit_time');
            $summary['version'] = $version;
            $summary['username'] = $this->user->getNameFromId($summary['user']);
        }
        if($summary['accepted']==true) {
            $summary['accepted'] = 'yes';
        } else {
            $summary['accepted'] = 'no';
        }
        if($summary['published']==true) {
            $summary['published'] = 'yes';
        } else {
            $summary['published'] = 'no';
        }
        if($summary['activated']==true) {
            $summary['activated'] = 'yes';
        } else {
            $summary['activated'] = 'no';
        }
        return $summary;
    }
    
    /**
     * Return replies to answer
     * @param type $id the answer id to get replies from.
     */
    public function getReviewReplies($id) {
        $replies = $this->reply->getReplies(null, $id, 999);
        for($c=0; $c<sizeof($replies); $c++) {
            array_push($replies[$c], 'username');
            $replies[$c]['username'] = $this->user->getNameFromId($replies[$c]['user_id']);
        }
        return $replies;
    }
    
    public function runEditAnswer($id, $details) {
        $this->answer->update($id, $details);
    }
}

?>