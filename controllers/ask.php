<?php
class Ask extends Controller {
    public function __construct() {
		parent::__construct();
                if(!$this->user->isLoggedIn()) {
                    $_SESSION['returnPage'] = $_GET['url'];
                    header('Location: '.ROOT.'login', TRUE, 302);
                }
	}
	
	public function index() {
		$this->view->topics = $this->category->getCategories();
                $this->view->bidBuddy = $this->model->bidBuddy(); //Returns array of all site topics and the average bid on questions associated with them. The user can then select which topic to view using javascript through the view.
		$this->view->render('ask/index');
	}
	
	public function runAsk() {
		$formData = array(
			'title' => array(
						'required'=>true,
						'min_length'=>3,
						'max_length'=>64
			),
			'topic' => array(
						'required'=>true
			),
			'full' => array(
						'min_length'=>1,
						'max_length'=>1024
			),
			'bid' => array(
						'required'=>true,
						'is_numeric'=>true,
						'min_value'=>10
			)	
		);		
                $this->form->addData($formData);
		if($this->form->isValid()) {
			$formData = $this->form->getFormData();
                        print_r($formData);
                        $userPoints = $this->points->getPoints($this->user->getUserId());
                        if($userPoints>=$formData['bid']) {
                            $this->model->runAsk($formData);
                            header('Location: '.ROOT.'/questions/');
                        } else {
                            $GLOBALS['error']->addError('points', 'You do not have enough points to bid that much.');
                            $this->index();
                        }
			
		} else {
			$this->index();
		}
	}
}
?>