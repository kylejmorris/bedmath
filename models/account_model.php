<?php
Class Account_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	/**
		Calculates transaction information and returns.
		@param $since: The earliest date to grab transactions from
	*/
	public function getTransactions($userId, $since, $type) {
		/*switch($since) { //running through string value of $since, determining the representation it holds as a timestamp
			case "day":
				$since = 86400; break;
			case "week":
				$since = 86400*7; break;
			case "month":
				$since = 86400*31; break;
			case "year":
				$since = 86400*365; break;
			case "all_time":
				$since = 9999999999; break;
			default: $since = 9999999999; break;
		}*/
		$pointsHistory = $this->points->getTransactions(1,10,$type,$since,$userId); //Getting array of user transactions	
		for($c=0; $c<sizeof($pointsHistory); $c++) {
			$userDetail = $this->user->getDetailFromId($pointsHistory[$c]['object']); //Get user details from whom was involved in the points transaction
			array_push($pointsHistory[$c], 'description'); //adding new index to array, to hold text description of transaction
			$transactionType = $this->points->getTransactionTypes($pointsHistory[$c]['transaction_type']); //Getting info on transaction type, based on the ID of transaction. Each ID is associated with a string version giving stronger description/detail.
			$pointsHistory[$c]['transaction_type'] = $transactionType[0]['name'];
			$pointsHistory[$c]['description'] = $transactionType[0]['description'];  //Transferring value of transaction type, into the main array that will be displayed
			$pointsHistory[$c]['object'] = $userDetail['username']; 
		
		}
		return $pointsHistory;
	}
	
	//generating array of point statistics and returning for display
	public function getPointStats($userId) {
		$stats = array('current', 'day', 'week', 'month', 'year', 'all_time', 'spent', 'rank'); //The details we will get. All time points earned, amount spent, etc. . . .
		$stats['current'] = $this->points->getPoints($userId); 
		$stats['day'] = $this->points->pointsEarned($userId, 'day');
		$stats['week'] = $this->points->pointsEarned($userId, 'week');
		$stats['month'] = $this->points->pointsEarned($userId, 'month');
		$stats['year'] = $this->points->pointsEarned($userId, 'year');
		$stats['all_time'] = $this->points->pointsEarned($userId, 'all_time'); 
		$query = "SELECT * FROM g0g1_users WHERE points > {$stats['current']}"; //Getting all users with more points than current user
		$row = $this->database->query($query);
		$stats['rank'] = $row->rowCount()+1;  //Counting how many rows were returned, basically getting ranking. 
		return $stats;
	}
	
	public function runProfile($userId, $formData) {
		$email = $formData['email'];
		$avatar = $formData['avatar'];
		$query = "UPDATE g0g1_users SET email='$email', avatar_id='$avatar' WHERE user_id='$userId'";
		$this->database->query($query);
	}
	
	public function questions($page, $userId, $limit) {
		$where = array('asked_by'=>$userId);
		$questions = $this->question->getQuestions($where, 'asked_by', $page, $limit);
		for($c=0; $c<sizeof($questions); $c++) {
			array_push($questions[$c], 'answer_count');
			$questions[$c]['answer_count'] = $this->question->getAnswerCount($questions[$c]['id']);
			$questions[$c]['asked_by'] = $this->user->getNameFromId($questions[$c]['id']);
			$questions[$c]['topic'] = $this->category->getNameFromId($questions[$c]['topic']);
		}
		if(sizeof($questions)==0) {
			$GLOBALS['error']->addError('question', 'You have not asked any questions.');
		}
		return $questions;
	}
        
        public function runEditQuestion($qid, $details) {
            $this->question->update($qid, $details);
        }
        
        public function answers($page, $userId, $limit) {
            $where = array('user'=>$userId);
            $answers = $this->answer->getAnswers($where, 'time', $page, $limit);
            for($c=0; $c<sizeof($answers); $c++) {
                array_push($answers[$c], 'question_title');
                $question = $this->question->getDetailById($answers[$c]['question_id']);
                $answers[$c]['question_title'] = $question['title'];
            }
            return $answers;
        }
        
        public function runEditAnswer($id, $details) {
             $this->answer->update($id, $details);
        }
        
        /**
         * @param type $userId the id of user getting new pass
         * @param type $password the new password
         */
        public function runNewPass($userId, $password) {
            $this->pass->setNewPass($userId, $password);
        }
	
}
?>