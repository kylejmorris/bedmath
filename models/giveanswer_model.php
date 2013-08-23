<?php
class GiveAnswer_Model extends Model {
	public function __construct() {
		parent::__construct();
	}
	

	public function question($id) {
		$questionData = $this->question->getDetailById($id);
		$questionData['asked_by'] = $this->user->getNameFromId($questionData['asked_by']);
		return $questionData;
	}
	
	public function getUserPotential($userId, $qid) {
		$potential = $this->answer->getPotential($userId, $qid);
		return $potential;
	}
}

?>