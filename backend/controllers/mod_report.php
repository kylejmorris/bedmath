<?php
Class Mod_Report extends Controller {
	public function __construct() {
		parent::__construct();
		$this->report = new Report();
	}
	
	public function index() {
		$this->view->render('mod_report/index');
	}
	
	public function reports() {
		$this->view->reports = $this->report->getReports();
		$this->view->render('mod_report/reports');
	}
	
	public function review($id) {
		$this->view->details = $this->report->getReportDetail($id);
		$this->view->render('mod_report/review');
	}
	
	public function runReport($id, $choice) {
		$this->report->setReportState($id, $choice);
		header('Location:'.ROOT.'mod/mod_report/reports');
	}
}
?>