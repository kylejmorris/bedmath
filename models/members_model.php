<?php
class Members_Model extends Model {
    public function __construct() {
      parent::__construct();
      $this->user = new User();
    }
    /**
    * Gets full list of users and their data, returns as multidimentional array
    * Note: Has parameters that deal with pagination. Can be changed to specify how many users to return
    * @param $page The page number being viewed, such as on the memberlist. 
    * Note: The page may not be required if method is being used purely in backend
    * if this is the case then just set $page to 1, and the user rows will begin from beginning. 
    * @param $count How many users to display on page. Default is 1
    * @param $order The order in which information is loaded. Default is by user_id
    */
    public function getUsers($page=1, $count=10, $order) {
	switch($order) { //Check value set as order, default will order info by username
		case 'user_id':
			$order = "user_id"; break;
		case "points":
			$order = 'points'; break;
		default: 
			$order = 'username'; break;
	}
        $start = ($page * $count)-$count ; //Determining which user to start gathering from, in terms of ID.
	$query = "SELECT * FROM g0g1_users ORDER BY username ASC LIMIT $start,$count"; //Getting all users
	$row = $this->database->query($query);
	$result = $row->fetchAll();
	for($c=0; $c<sizeof($result);$c++) {
		$result[$c]['user_level'] = $this->user->levelToText($result[$c]['user_level']); //Changing the value of user_level to the string equivilent 
	}
	return $result;
    }
    
    public function getMemberStats() {
	$stats = array('total_users' =>'','total_points'=>''); //Create array to hold statistics
	$query = "SELECT * FROM g0g1_users"; //getting all users
	$row = $this->database->query($query);
	$stats['total_users'] = $row->rowcount(); //Returns total count of users, based on row count
	$query = "SELECT SUM(points) FROM g0g1_users"; //Getting sum of all points column value
	$row = $this->database->query($query);
	$result = $row->fetch();
	$stats['total_points'] = $result[0]; //Assign value of total points into stats variable
	return $stats; //returning array once all data is set
    }
}

?>