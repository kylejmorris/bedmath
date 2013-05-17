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
     * Returns database rows regarding question based on id supplied
     * @param $id the id of question to grab. 
     */
    public function getDetailById($id) {
        $columns = array('id', 'topic', 'title', 'full', 'bid', 'asked_by', 'solved', 'answer', 'asked_time', 'published', 'unanswered');
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
        $columns = array('id', 'topic', 'title', 'full', 'bid', 'asked_by', 'solved', 'answer', 'asked_time', 'published', 'unanswered');
        $questions = $this->database->getByPage('g0g1_questions', $columns, $where, $order, $page, $limit);
        return $questions;
    }

    /**
     * Check if specified question has been been solved by a tutor. 
     * @param $id the id of question to check.
     */
    public function isSolved($id) {
        $question = $this->getDetailById($id);
        if ($question['solved'] == true) {
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
        $columns = array('id', 'topic', 'title', 'full', 'bid', 'asked_by', 'solved', 'answer', 'asked_time', 'published', 'answered');
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

}

?>