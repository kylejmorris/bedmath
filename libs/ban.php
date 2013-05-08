<?php
/**
* Manages bans on site users. Provides methods that allow further manipulation of bans.
* Ban data is located in the g0g1_bans table of database.
*/
Class Ban extends Database {
	public function __construct() {
		$this->database = new Database();
		$this->user = new User();
	}
	
	/**
	* Create a new ban on user_id
	* @param $userId the id of user to ban
	* @param $length length of ban, as string data. This will be converted to a timestamp accordingly.
	* @param $comments notes regarding the ban, displayed to user upon receiving ban. 
	*/
	public function newBan($userId=null, $length=null, $comments=null) {	
		switch($length) {
			case 'minute': $length = 60; break;
			case 'hour': $length = 60*60; break;
			case '1day': $length = 60*60*24; break;
			case '3days': $length = 60*60*24*3; break;
			case '7days': $length = 60*60*24*7; break;
			case '14days': $length = 60*60*24*14; break;
			case '1month': $length = 60*60*24*31; break;
			case '3months': $length = 60*60*24*30*3; break;
			case '6months': $length = 60*60*24*30*6; break;
			case '1year': $length = 60*60*24*365; break;
			case 'forever': $length = 60*60*24*365*50; break;
			default: $length = 60*60*24;
		}
		$createdBy = $this->user->getUserId();
		$createdTime = time();
		$expires = time() + $length;
		$query1 = "INSERT INTO g0g1_bans (user_id, created_by, created_time, expires, comments) VALUES ('$userId', '$createdBy', '$createdTime', '$expires', '$comments')";
		$this->database->query($query1);
		$query2 = "UPDATE g0g1_users SET user_level=0 WHERE user_id='$userId'";
		$this->database->query($query2);
	}
	
	public function getBanDetails($userId){
		$query = "SELECT * FROM g0g1_bans WHERE user_id='$userId' ORDER BY created_time DESC";
		$row = $this->database->query($query);
		$results = $row->fetchAll(); 
		return $results;
	}
	
	/**
	* Determine if user ban has expired.
	* @param $userId The id of user to determine ban expiration on. 
	* Note: This will check the most recent ban, in case the user has been banned before. Only the most recently issued ban shall be analysed
	* @return boolean true = expired, false = not expired
	*/
	public function banExpired($userId) {
		$query = "SELECT expires FROM g0g1_bans WHERE user_id='$userId'";
		$row = $this->database->query($query);
		$results = $row->fetch();
		$currentTime = time();
		if($results[0]<$currentTime) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* Unban specified user by changing user level and adjusting logs
	* @param $userId the id of user to unban
	*/
	public function unban($userId) {
		$query = "UPDATE g0g1_users SET user_level='2' WHERE user_id='$userId'";
		$this->database->query($query);
	}
	
	public function getBanCount() {
		$query = "SELECT COUNT(*) FROM g0g1_bans";
		$row = $this->database->query($query);
		$result = $row->fetch();
		return $result[0];
	}
	public function getBanHistory($page, $count, $since=null, $userId=null) {
		$start = ($page * $count) - $count; 
		$query = "SELECT * FROM g0g1_bans WHERE 1";
		if($userId!=null) {
			$query.= " AND user_id='$userId'";
		}
		if($since!=null) {
			switch($since) {
				case 'day': $since = 86400; break;
				case 'week': $since = 86400*7; break;
				case 'month': $since= (86400*365)/12; break;
				case 'year': $since= 86400*365; break;
				default: $since = 86400*7; 
			}
			$query.= " AND created_time>'$since'";
		}
		$query.=" LIMIT $start, $count";
		$stmt = $this->database->prepare($query);
		$stmt->execute();
		$results = $stmt->fetchAll();
		for($c=0; $c<sizeof($results); $c++) {
			$results[$c]['user_id'] = $this->user->getNameFromId($results[$c]['user_id']);
			$results[$c]['created_time'] = date("M d, Y h:i:s A", $results[$c]['created_time']);
			$results[$c]['expires'] = date("M d, Y h:i:s A", $results[$c]['expires']);
		}
		return $results;
	}
}
?>