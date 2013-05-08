<?php
class Redeem_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->question = new Question();
		$this->answer = new Answer();
	}
	

	public function runRedeem($formData, $userId) {
		$request_code = "";
		for($c=0; $c<32; $c++) {
			$request_code.=rand(0, 9);
		}
		$columns = array('request_code'=>(int)$request_code, 'user_id'=>$userId, 'amount'=>$formData['redeem_amount'], 'time'=>time(), 'status'=>'pending');
		$this->database->insertRow('g0g1_redeem', $columns);
	}
	
}

?>