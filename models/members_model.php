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
        if($order=='user_id') {
            $direction = 'DESC';
        }
	$users = $this->user->getUsers($page, $count, $order, $direction);
	return $users;
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