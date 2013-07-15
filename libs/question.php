<?php

/*
 * Used to manage questions posted to Bedmath. 
 */

class Question {

    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    /**
     * Checks if question belongs to specified user
     * @param $qid the questions id
     * @param $userId the users id
     */
    public function isOwner($qid, $userId) {
        $question = $this->getDetailById($qid);
        if($userId==$question['asked_by']) {
            return true;
        }
        return false;
    }
    
    /**
     * Returns database rows regarding question based on id supplied
     * @param $id the id of question to grab. 
     */
    public function getDetailById($id) {
        $columns = array('id', 'topic', 'title', 'full', 'bid', 'asked_by', 'answer', 'asked_time', 'published');
        $where = array('id' => $id);
        $question = $this->database->getRow('g0g1_questions', $columns, $where);
        return $question;
    }

    /**
     * Check if question exists based on id supplied
     * @param $id the numerical id of question to check.
     */
    public function exists($id) {
        $count = $this->database->getCount('g0g1_questions', array('id' => $id));
        if ($count == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Return number of answers question currently has associated with it.
     * @param $id the id of question to get answers for. 
     */
    public function getAnswerCount($id) {
        $count = $this->database->getCount('g0g1_answers', array('question_id' => $id));
        return $count;
    }

    /**
     * Gathers group of questions, used for loading on page or other views.
     * @param $where assoc array containing columns and the conditions they must meet
     * @param $order order of results
     * @param $page the current page being viewed on userend, specifying where to get data for questions in DB
     * @param $limit the maximum amount of records to gather
     */
    public function getQuestions($where, $order, $page, $limit) {
        $columns = array('id', 'topic', 'title', 'full', 'bid', 'asked_by', 'answer', 'asked_time', 'published');
        $questions = $this->database->getByPage('g0g1_questions', $columns, $where, $order, $page, $limit);
        $answer = new Answer();
        for ($c = 0; $c < sizeof($questions); $c++) {
            array_push($questions[$c], 'solved_by');
            array_push($questions[$c], 'answer_count');
            if ($this->isSolved($questions[$c]['id'])) {
                $answerData = $answer->getAcceptedAnswer($questions[$c]['id']);
                $questions[$c]['solved_by'] = $answerData['user'];
            } else {
                $questions[$c]['solved_by'] = null;
            }
            $questions[$c]['answer_count'] = $this->getAnswerCount($questions[$c]['id']);
        }
        return $questions;
    }

    /**
     * Check if specified question contains an answer in which was selected by student
     * @param $id the id of question to check.
     */
    public function isSolved($id) {
        $answer = new Answer();
        $result = $answer->getAcceptedAnswer($id);
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns the question in which is associated with the specified answer ID.
     * @param $id the answer id to get question from. 
     */
    public function getQuestionByAnswer($id) {
        $columns = array('id', 'topic', 'title', 'full', 'bid', 'asked_by', 'solved', 'answer', 'asked_time', 'published');
        $answer = new Answer();
        if ($answer->exists($id)) {
            $question = $this->database->getRow('g0g1_questions', $columns, array('a' => $id));
            return $question;
        }
        return -1;
    }

    /**
     * Return number of questions meeting WHERE clauses.
     * @param $where the conditions for columns to meet.
     */
    public function getQuestionCount($where) {
        $count = $this->database->getCount('g0g1_questions', $where);
        return $count;
    }

    /**
     * Add new question to database
     * @param $details the question details stored in array. Must contain required elements: 
     * [topic][title][full][bid][asked_by][asked_time]
     */
    public function addQuestion($details) {
        $columns = array('topic' => $details['topic'], 'title' => $details['title'], 'full' => $details['full'], 'bid' => $details['bid'], 'asked_by' => $details['asked_by'], 'asked_time' => $details['asked_time'], 'published' => 1);
        $this->database->insertRow('g0g1_questions', $columns);
    }

    /**
     * Similar to getQuestionCount() however the PHP PDO object does not allow table names in the query, so we're unable to say:
     * Select COUNT(*) from g0g1_questions WHERE *g0g1_answers.question_id*.
     * Can't do that sadly. So instead this method will run a default query without using the database object.
     * @param $userId the id of user who has unanswered questions
     * @param $topic the topic of questions
     * @param $page the page being viewed
     * @param $limit the max amount of questions to display per page
     */
    public function getUnanswered($userId, $topic, $page, $limit) {
        $start = ($page * $limit) - $limit;
        $query = "SELECT t1.id, t1.topic, t1.title, t1.full, t1.bid, t1.asked_by, t1.answer, t1.asked_time, t1.published
                    FROM g0g1_questions AS t1
                    LEFT JOIN g0g1_answers AS t2 ON t1.id = t2.question_id
                    WHERE t2.question_id IS NULL ";
        if ($userId != null && is_numeric($userId)) {//Only include if userid is specified
            $query.="AND t1.asked_by=" . $userId;
        }
        if ($topic != null && is_numeric($topic)) { //Only include where clause if topic is specified.
            $query.=" AND t1.topic=" . $topic;
        }
        $query.=" LIMIT {$start}, {$limit}";
        $stmt = $this->database->query($query);
        $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * Returns number of unanswered questions.
     * @param $userId the id of user who belongs to the question
     * @param $topic the topic of question
     */
    public function getUnansweredCount($userId, $topic, $page, $limit) {
        $start = ($page * $limit) - $limit;
        $query = "SELECT count(t1.id)
                    FROM g0g1_questions AS t1
                    LEFT JOIN g0g1_answers AS t2 ON t1.id = t2.question_id
                    WHERE t2.question_id IS NULL ";
        if ($userId != null && is_numeric($userId)) {
            $query.=" AND t1.asked_by=" . $userId;
        }
        if ($topic != null && is_numeric($topic)) { //Only include where clause if topic is specified.
            $query.=" AND t1.topic=" . $topic;
        }
        $query.=" LIMIT {$start}, {$limit}";
        $stmt = $this->database->query($query);
        $count = $stmt->fetch();
        return $count[0];
    }
    
    /**
     * Returns number of solved questions.
     * @param $userId the id of user who belongs to the question
     * @param $topic the topic of question
     */
    public function getSolvedCount($userId, $topic) {
        $query = "SELECT count(t1.id)
                    FROM g0g1_questions AS t1
                    LEFT JOIN g0g1_answers AS t2 ON t1.id = t2.question_id
                    WHERE t2.accepted=true ";
        if ($userId != null && is_numeric($userId)) {
            $query.=" AND t1.asked_by=" . $userId;
        }
        if ($topic != null && is_numeric($topic)) { //Only include where clause if topic is specified.
            $query.=" AND t1.topic=" . $topic;
        }
        $stmt = $this->database->query($query);
        $count = $stmt->fetch();
        return $count[0];
    }
    
    /**
     * Returns data associated with solved questions.
     * @param $userId the id of user who belongs to the question
     * @param $topic the topic of question
     */
    public function getSolved($userId, $topic) {
        $query = "SELECT *
                    FROM g0g1_questions AS t1
                    LEFT JOIN g0g1_answers AS t2 ON t1.id = t2.question_id
                    WHERE t2.accepted=true ";
        if ($userId != null && is_numeric($userId)) {
            $query.=" AND t1.asked_by=" . $userId;
        }
        if ($topic != null && is_numeric($topic)) { //Only include where clause if topic is specified.
            $query.=" AND t1.topic=" . $topic;
        }
        $stmt = $this->database->query($query);
        $details = $stmt->fetchAll();
        return $details;
    }
    
    /**
     * Update existing question, along with creating backup version in database.
     * @param $qid the question id being updated
     * @param $details the question details stored in array. Must contain required elements: 
     * [topic][title][full][bid][asked_by][asked_time]
     */
    public function update($qid, $details) {
        $editTime = time(); 
        $version = $this->getQuestionVersion($qid); //The version of current question being backed up
        $cQuestion = $this->getDetailById($qid); //The current question data, not edited.
        $this->database->insertRow('g0g1_questions_log', array('question_id'=>$cQuestion['id'], 'topic'=>$cQuestion['topic'], 'title'=>$cQuestion['title'], 'full'=>$cQuestion['full'], 'bid'=>$cQuestion['bid'], 'asked_by'=>$cQuestion['asked_by'], 'answer'=>$cQuestion['answer'], 'asked_time'=>$cQuestion['asked_time'], 'published'=>$cQuestion['published'], 'version'=>$version, 'edit_time'=>$editTime));
        $this->database->update('g0g1_questions', array('topic'=>$details['topic'], 'title'=>$details['title'], 'full'=>$details['full'], 'bid'=>$details['bid'], 'answer'=>$details['answer'], 'published'=>$details['published']), array('id'=>$qid));
        
    }
    
    /**
     * Returns current version count of this question, default is 1 if no version exist before editing.
     */
    public function getQuestionVersion($qid) {
        $version = $this->database->getCount('g0g1_questions_log', array('question_id'=>$qid))+1;
        return $version;
    }
    
    /**
     * Returns question details according to specific version.
     * @pre Assume the version number is existent. 
     * @param type $qid the id of question
     * @param type $version the version to get information from backup tables.
     */
    public function getDetailByVersion($qid, $version) {
        $columns = array('question_id', 'topic', 'title', 'full', 'bid', 'asked_by', 'answer', 'asked_time', 'published', 'version', 'edit_time');
        $question = $this->database->getRow('g0g1_questions_log', $columns, array('question_id'=>$qid, 'version'=>$version));
        return $question;
    }
}

?>