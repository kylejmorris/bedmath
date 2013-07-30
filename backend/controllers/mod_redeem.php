<?php
class Mod_Redeem extends Controller {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->pagination = new Pagination();
		$this->form = new Form();
		$this->ban = new Ban();
		$this->report = new Report();
	}
	
	public function index() {
                $this->view->summary = $this->model->getRedeemSummary();
		$this->view->render('mod_redeem/index');
	}
        
        /**
         * Viewing redemptions that have been accepted and user has been paid.
         * @param type $page the page being viewed.
         */
        public function paid($page) {
            if($page==null) {
                $page = 1;
            }
            $this->view->requests = $this->model->getPaid($page, 10);
            $this->view->pagination = $this->pagination->getPageList($page, 10, sizeof($this->view->requests));
            $this->view->render('mod_redeem/paid');
        }
        
        /**
         * Viewing redemptions that have been accepted and await payment.
         * @param type $page the page being viewed.
         */
        public function accepted($page) {
            if($page==null) {
                $page = 1;
            }
            $this->view->requests = $this->model->getAccepted($page, 10);
            $this->view->pagination = $this->pagination->getPageList($page, 10, sizeof($this->view->requests));
            $this->view->render('mod_redeem/accepted');
        }
        
        /**
         * Viewing redemptions that are currently unreviewed and pending.
         * @param type $page the page being viewed.
         */
        public function pending($page) {
            if($page==null) {
                $page = 1;
            }
            $this->view->requests = $this->model->getPending($page, 10);
            $this->view->pagination = $this->pagination->getPageList($page, 10, sizeof($this->view->requests));
            $this->view->render('mod_redeem/pending');
        }
        
        /**
         * Viewing redemptions that have been denied during review process.
         * @param type $page the page being viewed.
         */
        public function denied($page) {
            if($page==null) {
                $page = 1;
            }
            $this->view->requests = $this->model->getDenied($page, 10);
            $this->view->pagination = $this->pagination->getPageList($page, 10, sizeof($this->view->requests));
            $this->view->render('mod_redeem/denied');
        }
        
        /**
         * Review a redeem request before sending it to cashout waiting list.
         * @param type $id
         */
        public function review($id) {
            $this->view->details = $this->model->getRedeemReview($id); 
            $this->view->render('mod_redeem/review');
        }
        
        /**
         * Runs if a pending review is confirmed after being checked by a staff member.
         * @param type $id the redeem request id
         */
        public function reviewAccepted($id) {
            $this->model->reviewAccepted($id);
            header('Location: '.ROOT.'mod/mod_redeem/pending');
        }
        
        /**
         * Runs if a pending review is denied after being checked by a staff member.
         * @param type $id the redeem request id
         */
        public function reviewDenied($id) {
            $this->model->reviewDenied($id);
            header('Location: '.ROOT.'mod/mod_redeem/pending');
        }
        
        /**
         * Run payment from accepted page and set request as 'paid'
         * @param type $id
         */
        public function runPaid($id) {
            $this->model->runPaid($id);
            header('Location: '.ROOT.'mod/mod_redeem/accepted');
        }
}

?>

