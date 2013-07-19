<?php

/**
 * Assistence given in response to a question posted by another user. 
 * Hopefully the answer is of good quality.
 */
class Answer {

    public function __construct() {
        $this->database = new Database();
        $this->reputation = new Reputation();
        $this->question = new Question();
        $this->reply = new Reply();
    }

    /**
     * 
     * Returns integer representing number of answers posted by user.
     * @param $where the where conditions for collecting count.
     */
    public function getAnswerCount($where) {
        $count = $this->database->getCount('g0g1_answers', $where);
        return $count;
    }

    /**
     * Checks if the associated question, is unanswered. This would mean it's pending. 
     * If this answer is unaccepted and the question it's with has been closed, 
     * then the answer was denied. 
     */
    public function isPending($id) {
        $answer = $this->getAnswerById($id);
        if ($answer['accepted'] == true) {
            return false; //not pending
        }
        $question = $this->question->getQuestionByAnswer($id);
        if ($this->question->isSolved($question['id'])) {
            $acceptedAnswer = $this->getAcceptedAnswer($question['id']);
            if ($id == $acceptedAnswer) {
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    /**
     * Check if user belongs to associated answer.
     * @param $id the answer id
     * @param $userId the id of user to check
     */
    public function isOwner($id, $userId) {
        $answer = $this->getAnswerById($id);

        if($answer['user']==$userId) {
            return true;
        }
        return false;
    }
    
    /**
     * Gather answer data based on supplied id. 
     */
    public function getAnswerById($id) {
        $columns = array('id', 'question_id', 'user', 'full_text', 'time', 'published','activated', 'accepted', 'edit_time');
        $where = array('id' => $id);
        $answers = $this->database->getRow('g0g1_answers', $columns, $where);
        return $answers;
    }
    
    /**
     * Returns answers based on given data.
     * @param $where the where clause
     * @param $order the column order to return data by
     * @param $page the current page being viewed
     * @param $limit the maximum amount of data to load per page.
     */
    public function getAnswers($where, $order, $page, $limit) {
        $columns = array('id', 'question_id', 'user', 'full_text', 'time', 'published', 'activated', 'accepted');
        $answers = $this->database->getByPage('g0g1_answers', $columns, $where, $order, $page, $limit);
        for($c=0; $c<sizeof($answers); $c++) {
            array_push($answers[$c], 'replies');
            $answers[$c]['replies'] = $this->reply->getReplies($answers[$c]['question_id'], $answers[$c]['id']);
        }
        return $answers;
    }

    public function exists($id) {
        $count = $this->database->getCount('g0g1_answers', array('id' => $id));
        if ($count != 0) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Check if answer exists, but belongs to the specified question.
     */
    public function existsWithinQuestion($answerId, $qid) {
        $count = $this->database->getCount('g0g1_answers', array('id'=>$answerId, 'question_id'=>$qid));
        if($count !=0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Supply new answer to specific question.
     * @param $qid the id of question receiving new answer.
     * @param $columns the column data to insert, supplied within associative array where index names are the column names.
     */
    public function addAnswer($qid, $columns) {
        if ($this->database->insertRow('g0g1_answers', $columns)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns accepted answer accociated with question, there can only be one.
     */
    public function getAcceptedAnswer($qid) {
        $columns = array('id', 'question_id', 'user', 'full_text', 'time', 'published', 'activated', 'accepted');
        $where = array('question_id' => $qid, 'accepted' => 1);
        return $this->database->getRow('g0g1_answers', $columns, $where);
    }

    /**
     * Returns answers associated with specific question
     * @param $id the question id to get answers from. 
     */
    public function getAnswersByQuestion($id) {
        $columns = array('id', 'question_id', 'user', 'full_text', 'time', 'published', 'activated', 'accepted');
        $where = array('question_id' => $id);
        $answers = $this->database->getRows('g0g1_answers', $columns, $where, 'time');
        for($c=0; $c<sizeof($answers); $c++) {
            array_push($answers[$c], 'replies');
            $answers[$c]['replies'] = $this->reply->getReplies($answers[$c]['question_id'], $answers[$c]['id']);
        }
        return $answers;
    }

    /**
     * Calculates the difference in reputation between the user posting an answer and the others who have already done so.
     * This lets the tutor know how much potential they have to be selected, based on reputation alone. 
     * @param $userId the id of tutor
     * @param $qid the id of question being answered.
     */
    public function getPotential($userId, $qid) {
        //$this->database->getRowSum(
        $answers = $this->getAnswersByQuestion($qid); //Get user data from those who posted answers to this question. 
        $qDetails = $this->question->getDetailById($qid);
        $mainUserRep = $this->reputation->getUserRep($userId, $qDetails['topic']);
        $position = 0; //How many users have higher reputation than the one we are scanning. 
        foreach ($answers as $answer) {
            if ($answer['user'] != $userId) { //Don't want to scan the user who is checking in the first place. 
                $otherUserRep = $this->reputation->getUserRep($answer['user'], $qDetails['topic']); //Getting rep each other user has in this topic. 			
                if ($otherUserRep > $mainUserRep) {
                    $position++; //stating 1 more other user has higher potential than the tutor currently answering.
                }
            }
        }
        return $position;
    }

    /**
     * Returns number of answers for each topic.
     * @param $userId the id of user to get answers from.
     */
    public function getMostAnsweredTopic($userId) {
        $topic = new Category();
        $topics = $topic->getCategories();
        $mostAnswered = null; //Topic id where most answers are present.
        $highest = 0; //Amount in topic
        foreach ($topics as $top) {
            $query = "SELECT COUNT(*) FROM g0g1_answers, g0g1_questions WHERE g0g1_answers.user='$userId' AND g0g1_questions.id=g0g1_answers.question_id AND g0g1_questions.topic='{$top['cat_id']}'";
            $result = $this->database->query($query);
            $count = $result->fetch();
            if($count[0]>$highest) {
                $mostAnswered = $top['name'];
            }
        }
        if($mostAnswered==null) {
            $mostAnswered = "None";
        }
        return $mostAnswered;
    }
    
    /**
     * Returns user in which received the most help from this tutor.
     */
    public function getMostSupported() {
        
    }
    
    /**
     * Update existing answer, along with creating backup version in database.
     * @param $id the answer id being updated
     * @param $details the answer details stored in array. Must contain required elements: 
     * [topic][title][full][bid][asked_by][asked_time]
     */
    public function update($id, $details) {
        $editTime = time(); 
        $version = $this->getAnswerVersion($id); //The version of current answer being backed up
        $cAnswer = $this->getAnswerById($id); //The current answer data, not edited.
        $this->database->insertRow('g0g1_answers_log', array('id'=>$cAnswer['id'], 'question_id'=>$cAnswer['question_id'], 'user'=>$cAnswer['user'], 'full_text'=>$cAnswer['full_text'], 'time'=>$cAnswer['time'], 'published'=>$cAnswer['published'], 'activated'=>$cAnswer['activated'],'accepted'=>$cAnswer['accepted'], 'version'=>$version, 'edit_time'=>$editTime));
        $this->database->update('g0g1_answers', array('full_text'=>$details['full_text'], 'published'=>$details['published'], 'activated'=>$details['activated'], 'accepted'=>$details['accepted'], 'edit_time'=>$editTime), array('id'=>$id));
        
    }
    
    /**
     * Returns current version count of this answer, default is 1 if no version exist before editing.
     */
    public function getAnswerVersion($id) {
        $version = $this->database->getCount('g0g1_answers_log', array('id'=>$id))+1;
        return $version;
    }
    
    /**
     * Return answer according to its version. Assuming the version supplied exists.
     * @param type $id the answer id
     * @param type $version the answers version to get data from.
     */
    public function getAnswerByVersion($id, $version) {
        $columns = array('id', 'question_id', 'user', 'full_text', 'time', 'edit_time', 'published', 'accepted', 'activated');
        return $this->database->getRow('g0g1_answers_log', $columns, array('id'=>$id, 'version'=>$version));
    }
}

?>