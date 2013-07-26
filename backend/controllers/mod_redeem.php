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
            
        }
}

?>

