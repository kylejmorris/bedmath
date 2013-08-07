<?php
Class Mod_Report extends Controller {
	public function __construct() {
		parent::__construct();
		$this->report = new Report();
                $this->pagination = new Pagination();
	}
	
	public function index() {
		$this->view->render('mod_report/index');
	}
	
	public function reports($page, $state) {
                if($state==null) {
                    $state = 'pending';
                }
                if($page==null || $page==0) {
                    $page=1;
                }
                $reportCount = $this->report->getReportCount('state');
                $this->view->pagination = $this->pagination->getPageList($page, 10, $reportCount);
		$this->view->reports = $this->report->getReports($page, 10, $state);
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