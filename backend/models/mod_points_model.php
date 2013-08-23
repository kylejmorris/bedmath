<?php
class Mod_Points_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	/**
	* Displays list of registered users and the points statistics associated. 
	* This is not to be confused with the user management page, in which also displays user details. 
	* @param $page The current page being displayed
	* @param $limit maximum amount of users to display on page
	* @param $order the order in which to list users
	*/
	public function viewUsers($page, $limit, $order) {
		$users = $this->user->getUsers($page, $limit, $order);
		for($c=0; $c<sizeof($users); $c++) {
			array_push($users[$c], 'earn_day', 'earn_week', 'earn_month', 'earn_year', 'earn_all_time');
			$users[$c]['earn_day'] = $this->points->pointsEarned($users[$c]['user_id'], 'day');
			$users[$c]['earn_week'] = $this->points->pointsEarned($users[$c]['user_id'], 'week');
			$users[$c]['earn_month'] = $this->points->pointsEarned($users[$c]['user_id'], 'month');
			$users[$c]['earn_year'] = $this->points->pointsEarned($users[$c]['user_id'], 'year');
			$users[$c]['earn_all_time'] = $this->points->pointsEarned($users[$c]['user_id'], 'all_time');
		}
		return $users;
	}
	
	public function transactions($page=1, $count=10, $type=null, $time='day', $userId=null) {
		$transactions = $this->points->getTransactions($page, $count, $type, $time, $userId);
		return $transactions;
	}
	
	public function getPointsStats() {
		$stats = array('total_points' => '',
				'richest_user' => '',
				'earned_today' => '',
				'lost_today' => '');
		$stats['total_points'] = $this->points->getCommunityPoints();
		$stats['richest_user'] = $this->points->getRichestUser();
		$time = time()-86400;
		$query = "SELECT SUM(points) FROM g0g1_points_log WHERE time>'$time' AND points>0";
		$row = $this->database->query($query);
		$results = $row->fetch();
		$stats['earned_today'] = $results[0];
		$query = "SELECT SUM(points) FROM g0g1_points_log WHERE time>'$time' AND points<0";
		$row = $this->database->query($query);
		$results = $row->fetch();
		$stats['lost_today'] = $results[0];
		return $stats;
	}
	
	public function runEdit($formData) {
		$userDetail = $this->user->getDetailFromId($formData['user_id']);
		$currentPoints = $userDetail['points'];
		$changeInPoints = 0;
		$transferType = 2;
		if($currentPoints<$formData['points']) { //Points have increased
			$transferType = 1;
			$changeInPoints = abs($currentPoints-$formData['points']);
			$this->points->addPoints($formData['user_id'], $changeInPoints, 1);
		} else { //Points have decreased
			$transferType = 2;
			$changeInPoints = abs($currentPoints-$formData['points']);
			$this->points->removePoints($formData['user_id'], $changeInPoints, 2);
		}
		
	}
}

?>