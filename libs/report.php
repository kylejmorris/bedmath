<?php
class Report extends Database {
	function __construct() {
		$this->database = new Database();
		$this->user = new User();
	}
	
	public function getReportCount() {
			$count = $this->database->getCount('g0g1_report_log', array('state'=>0));
			return $count;
	}
	
	public function getReportReasons($type=null) {
		if($type!=null) {
			$query = "SELECT * from g0g1_report_reason WHERE type_id='$type'";
		} else {
			$query = "SELECT * from g0g1_report_reason";
		}
		$row = $this->database->query($query); 
		$result = $row->fetchAll();
		return $result; 
	}
	
	//Stores report in database using data supplied within parameters
	//Parameters are $report, being an array containing logging information (userid etc)
	public function logReport($report) {
		$type = $report['type'];
		$content_id = $report['content_id'];
		$reporter = $report['reporter'];
		$reason = $report['reason'];
		$evidence = $report['evidence'];
		$comments = $report['comments'];
		$time = time(); 
		$query = "INSERT INTO g0g1_report_log (id, type, content_id, reporter, reason, evidence, comments, time) VALUES ('', '$type', '$content_id', '$reporter', '$reason', '$evidence', '$comments', '$time')";
		$this->database->query($query);
	}
	
	//Returns name of type based on supplied ID
	public function typeIdToName($id) {
		$query = "SELECT name FROM g0g1_report WHERE type_id='$id'";
		$row = $this->database->query($query);
		$result = $row->fetch();
		return $result[0];
	}
	
	public function reasonIdToName($id) {
		$query = "SELECT name FROM g0g1_report_reason WHERE id='$id'";
		$row = $this->database->query($query);
		$result = $row->fetch();
		return $result[0];
	}
	
	/**
	* Gets reports based on variety of conditions.
	* @param $page the page in which is being viewed, each page may contain reports.
	* @param $count the maximum number of records to list per page
	* @param $state the review state of report, 1=reviewed, 0=needs moderation.
	* @param $type the type of reports to get. Such as image reports/writing/user/etc
	* @param $reason the reason content was reported. Makes it easier to locate urgent reports.
	* @return Associative array.
	*/
	public function getReports($page=1, $count=10, $state=0, $type='all', $reason='all') {
		$start = ($page * $count)-$count;
		$query = $query = "SELECT * FROM g0g1_report_log WHERE 1 "; //default query
		
		if($state!='all') { //Adding conditions if values are set. 
			$query .= "AND state=:state ";
		}
		if($type!='all') {
			$query .= "AND type=:type ";
		}
		if($reason!='all') {
			$query .= "AND reason=:reason ";
		}
		$query .= "LIMIT $start, $count"; 	
		$stmt = $this->database->prepare($query);
		if(preg_match('/:state/', $query)) {
			$stmt->bindParam(':state', $state);
		}
		if(preg_match('/:type/', $query)) {
			$stmt->bindParam(':type', $type);
		}
		if(preg_match('/:reason/', $query)) {
			$stmt->bindParam(':reason', $reason);
		}
		$stmt->execute();
		$results = $stmt->fetchAll(); 
		for($c=0; $c<sizeof($results); $c++) {
			$results[$c]['type'] = $this->typeIdToName($results[$c]['type']);
			$results[$c]['reporter'] = $this->user->getNameFromId($results[$c]['reporter']);
			$results[$c]['reason'] = $this->reasonIdToName($results[$c]['reason']);
			if($results[$c]['state']==0) {
				$results[$c]['state']='needs review';
			} elseif($results[$c]['state']==1){
				$results[$c]['state']='confirmed';
			} else {
				$results[$c]['state']='denied';
			}
			$results[$c]['time'] = date('g:m M d Y', $results[$c]['time']);
		}
		return $results;
	}
	
	public function getReportDetail($id) {
		$query = "SELECT * FROM g0g1_report_log WHERE id='$id'";
		$row = $this->database->query($query);
		$result = $row->fetchAll();
		$result[0]['type'] = $this->typeIdToName($result[0]['type']);
		$result[0]['reason'] = $this->reasonIdToName($result[0]['reason']);
		$result[0]['time'] = date('g:m M d Y', $result[0]['time']);
		$result[0]['reporter'] = $this->user->getNameFromId($result[0]['reporter']);
		return $result; 
	}
	
	public function setReportState($id, $state) {
		$query = "UPDATE g0g1_report_log SET state='$state' WHERE id='$id'";
		$this->database->query($query);
	}
	

}

?>
