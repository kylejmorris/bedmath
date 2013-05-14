<?php
class Reporting_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->report = new Report(); 
	}
	
	//Called from controller upon writing report being submitted
	public function runReportWriting($report) {
		$user_id = Session::get('user_id'); 
		$report['type'] = 2; //2 represents 'writing' and lets the database know what is being reported
		$report['reporter'] = $user_id; //ID of user who sent in report
		$report['time'] = time();
		$this->report->logReport($report); //record report in database with specified form data 
	}
	
	
	//Called from controller upon writing report being submitted
	public function runReportUser($report) {
		$user_id = Session::get('user_id'); 
		$report['type'] = 1; //2 represents 'writing' and lets the database know what is being reported
		$report['reporter'] = $user_id; //ID of user who sent in report
		$report['time'] = time();
		$this->report->logReport($report); //record report in database with specified form data 
	}
        
        public function runReportQuestion($report) {
                $user_id = Session::get('user_id'); 
		$report['type'] = 3; //2 represents 'writing' and lets the database know what is being reported
		$report['reporter'] = $user_id; //ID of user who sent in report
		$report['time'] = time();
		$this->report->logReport($report); //record report in database with specified form data 
        }
}

?>