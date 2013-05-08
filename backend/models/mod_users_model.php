<?php
class Mod_Users_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->ban = new Ban();
		$this->user = new User();
	}
	
	
	public function getUserStats() {
		$stats = array('total_users' => '',
				'total_activated' => '',
				'total_banned' => '');
		$stats['total_users'] = $this->user->userCount();
		
		$query = "SELECT COUNT(*) FROM g0g1_users WHERE user_level=0";
		$row = $this->database->query($query);
		$results = $row->fetch();
		$stats['total_banned'] = $results[0];
		
		$query = "SELECT COUNT(*) FROM g0g1_users WHERE activated=1";
		$row = $this->database->query($query);
		$results = $row->fetch();
		$stats['total_activated'] = $results[0];
		return $stats;
	}
	/**
	* Updates user information specified within editing form.
	* @param $userId the id of user being updated
	* @param $formData data from editing form in which contains updates.
	*/
	public function runEdit($userId, $formData) {
		$query = "UPDATE g0g1_users SET username='{$formData['username']}', 
		email='{$formData['email']}',
		password='{$formData['password']}',
		activated='{$formData['activated']}',
		user_level='{$formData['user_level']}'
		WHERE user_id='$userId'";
		$this->database->query($query);
	}
	
	public function runNewBan($userId, $formData) {
		$this->ban->newBan($userId, $formData['length'], $formData['comments']); 
	}
}

?>