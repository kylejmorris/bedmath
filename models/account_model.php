<?php
Class Account_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->points = new Points(); 
		$this->user = new User();
		$this->writing = new Writing();
		$this->question = new Question();
		$this->category = new Category();
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
			$transactionType = $this->points->getTransactionType($pointsHistory[$c]['transaction_type']); //Getting info on transaction type, based on the ID of transaction. Each ID is associated with a string version giving stronger description/detail.
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
	
	/**
	* Returns summary stats about all writing as a whole.
	* @param $userId The id of user to obtain writing stats for. 
	*/
	public function getWritingStats($userId) {
		$stats = array('total_views', 'total_unlocks', 'writing_count', 'pending_count', 'published_count');
		$stats['total_views'] = $this->writing->getTotalViews($userId);
		$stats['total_unlocks'] = $this->writing->getTotalUnlocks($userId); 
		
		$query = "SELECT COUNT(*) FROM g0g1_writing WHERE publisher_id = '$userId'"; 
		$row = $this->database->query($query);
		$result = $row->fetch(); 
		$stats['writing_count'] = $result[0];
		
		$query = "SELECT COUNT(*) FROM g0g1_writing WHERE publisher_id = '$userId' AND activated = '0'"; 
		$row = $this->database->query($query);
		$result = $row->fetch();
		$stats['pending_count'] = $result[0];
		
		$query = "SELECT COUNT(*) FROM g0g1_writing WHERE publisher_id = '$userId' AND published = '1'";
		$row = $this->database->query($query);
		$result = $row->fetch();
		$stats['published_count'] = $result[0];
		return $stats;
		
	}
	
	/**
	* Gets details on each writing submission by user.
	* @param $userId The id of user to obtain writing details on. 
	*/
	public function getWritingDetails($userId) {
		$detail = $this->writing->getDetailBy('publisher_id', $userId); 
		for($c=0; $c<sizeof($detail); $c++) {
			switch($detail[$c]['activated']) { //Run through possible values of activation state
				case 0: $detail[$c]['activated'] = 'pending'; break;
				case 1: $detail[$c]['activated'] = 'activated'; break;
				case 2: $detail[$c]['activated'] = 'deactivated'; break;
				case 3: $detail[$c]['activated'] = 'rejected'; 
			}
			switch($detail[$c]['published']) { //Run through possible values of published stated
				case 0: $detail[$c]['published'] = 'unpublished'; break;
				case 1: $detail[$c]['published'] = 'published'; break;
			}
			$query = "SELECT name FROM g0g1_category WHERE cat_id = {$detail[$c]['category']}"; //Getting string value of category that writing is in.
			$row = $this->database->query($query);
			$category = $row->fetch(); 
			$detail[$c]['category'] =  $category[0]; //Index 0 holds the actual value
			$query = "SELECT name FROM g0g1_writing_type WHERE type_id = {$detail[$c]['type']}"; //Getting string value of category that writing is in.
			$row = $this->database->query($query);
			$type= $row->fetch(); 
			$detail[$c]['type'] = $type[0];
			if($detail[$c]['earn_type']=='pps') {
				$detail[$c]['total_earned'] = $detail[$c]['reward_amount']; //Setting to amount given upon having content posted
			} else {
				$unlocks = $detail[$c]['unlock_count'];
				$price = $detail[$c]['lock_price'];
				$detail[$c]['total_earned'] =  $price * $unlocks; 
			}
		}
		return $detail;
	}
	
	public function runWritingEdit($id, $form) {
		$query = "UPDATE g0g1_writing SET title ='{$form['title']}', description = '{$form['description']}', published=0, activated=0 WHERE content_id= $id"; 
		echo $query;
		$this->database->query($query); 
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
	
}
?>