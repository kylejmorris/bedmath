<?php
/**
 * Upon a question being posted on bedmath, answers may be supplied. The reply class is used when a further response is given to an answer.
 * For example: If a student receives a good answer, but still wishes to confirm a final piece of information, they may reply to said tutor accordingly.
 * The tutor may reply back to the student, and this allows a chain/thread structure for the system. 
 * Note: Only 1-on-1 is supported, where 1 student can reply back and forth with 1 tutor. Other tutors can't dive into someone elses thread, but they can make their own if needed!
 */
class Reply {
    
    public function __construct() {
        $this->database = new Database();
        $this->user = new User();
    }
    /**
     * @param $columns array of database columns that will hold required values.
     */
    public function addReply($columns) {
        $this->database->insertRow('g0g1_replies', $columns);
    }
    
    /**
     * Returns array of replies associated with the corresponding answer id
     * @param $qid the id of question
     * @param $answerId the id of answer associated with question.
     * @param $limit max amount of replies to get.
     */
    public function getReplies($qid, $answerId, $limit=3) {
        $columns = array('id', 'answer_id', 'question_id', 'user_id', 'time', 'full_text');
        $replies = $this->database->getRows('g0g1_replies', $columns, array('question_id'=>$qid, 'answer_id'=>$answerId), array('time', 'DESC'), $limit);
        $replies = array_reverse($replies);
        for($c=0; $c<sizeof($replies); $c++) {
            array_push($replies[$c], 'username');
            $replies[$c]['username'] = $this->user->getNameFromId($replies[$c]['user_id']);
        }
        return $replies;
    }
    
    /**
     * Return count of how many replies have been made to an answer.
     * @param type $qid the question id
     * @param type $answerId the answer id to get reply count from.
     */
    public function getReplyCount($qid, $answerId) {
        return $this->database->getCount('g0g1_replies', array('question_id'=>$qid, 'answer_id'=>$answerId));
    }
    
    /**
     * @param $qid the id of question
     * @param $answerId the id of answer associated with question.
     * @param $columns array of database columns that will hold required values.
     */
    public function editReply($qid, $answerId) {
       
    }
    
    /**
     * Determine if specified userid is the owner of answer in which they are replying to. 
     * Only the student, and tutor who made the answer may reply to the thread.
     * @param $qid the id of question
     * @param $answerId the id of answer associated with question.
     * @param $columns array of database columns that will hold required values.
     */
    public function isOwner($qid, $answerId) {
        
    }
    
}
?>
