<?php
/**
* Manages reputation of users on the site. Reputation allows the customer to find the most reliable source of support possible, in a short time.
* Note: Reputation is not the final decision in a users success, but rather a tool used to help build them through experience on the site.
*/
class Reputation {
	
	public function __construct() {
		$this->database = new Database();
	}
	
	/**
	* Get the amount of reputation a user has.
	* @param $id the id of user to get reputation from.
	* @param $topic the topic to get reputation amount from.
	*/
	public function getUserRep($id, $topic) {
		$where = array('object'=>$id, 'topic'=>$topic);
		$rep = $this->database->getRowSum('g0g1_rep_log', 'amount', $where);
		if($rep==null) {
			$rep = 0;
		}
		return $rep;
	}
	
	/**
	* Increase a users reputation and then log action in database.
	* @param $user the user to increase reputation
	* @param $amount numerical value representing increase.
	*/
	public function addRep($user, $amount) {
	
	}
	
	/**
	* Decrease a users reputation and then log action in database.
	* @param $user the user to decrease reputation
	* @param $amount numerical value representing decrease.
	*/
	public function removeRep($user, $amount) {
	
	}
}
?>