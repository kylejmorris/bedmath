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
	* Gather answer data based on supplied id. 
	*/
	public function getAnswerById($id) {
		$columns = array('id', 'question_id', 'user', 'full_text', 'time', 'votes', 'published', 'accepted');
		$where = array('id'=>$id);
		$answers = $this->database->getRow('g0g1_answers', $columns, $where);
		return $answers;
	}
	
	public function exists($id) {
		$id = $this->database->getCount('g0g1_answers', array('id'=>$id));
		if($id!=0) {
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
		if($this->database->insertRow('g0g1_answers', $columns)) {
			return true;
		} else {
			return false;
		}
	}
	
        /**
         * Returns accepted answer accociated with question, there can only be one.
         */
        public function getAcceptedAnswer($qid) {
            $columns = array('id', 'question_id', 'user', 'full_text', 'time', 'votes', 'published', 'accepted');
            $where = array('question_id'=>$qid, 'accepted'=>1);
            return $this->database->getRow('g0g1_answers', $columns, $where);
        }
	/**
	* Returns answers associated with specific question
	* @param $id the question id to get answers from. 
	*/
	public function getAnswersByQuestion($id) {
		$columns = array('id', 'question_id', 'user', 'full_text', 'time', 'votes', 'published', 'accepted');
		$where = array('question_id'=>$id);
		$answers = $this->database->getRows('g0g1_answers', $columns, $where, 'votes');
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
		foreach($answers as $answer) {
			if($answer['user']!=$userId) { //Don't want to scan the user who is checking in the first place. 
				$otherUserRep = $this->reputation->getUserRep($answer['user'], $qDetails['topic']); //Getting rep each other user has in this topic. 			
				if($otherUserRep>$mainUserRep) {
					$position++; //stating 1 more other user has higher potential than the tutor currently answering.
				}
			}
		}
		return $position; 
	}
}
?>