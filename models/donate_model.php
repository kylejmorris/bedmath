<?php
class Donate_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	//Called from donate controller upon runPoints being executed
	public function runPoints($formData, $receiverId, $senderId) {
		$this->points->removePoints($senderId, $formData['points'], 7, $receiverId); //Remove points from sender
		$receivedPoints = $this->points->deductTaxFee($formData['points'], 10); //Deducting % of taxation fee, 10% in this case. The receiver will get 90% of what was donated
		$this->points->addPoints($receiverId, $receivedPoints, 8, $senderId); //Gives points to receiver, after transfer tax was included
	}
}

?>