<?php
class Profile extends Controller {
    public function __construct() {
            parent::__construct();
            $this->writing = new Writing();
    }
    
    //Nothing here really...
    public function index() {
    }
    
    /**
    * Viewing of users profile page containing specified data about themselves and their stance on the site.
    * @param $userId The id of user in which to get information on. 
    */
    public function user($userId) {
	if(!empty($userId)) { //Check if id was supplied in url
		$userDetail = $this->model->getUserDetail($userId); //Run model getting user details
		$userStats = $this->model->getUserStats($userId); //Calling to model, to generate specific statistical info
		$this->view->userDetail = $userDetail; //Send to template
		$this->view->userStats = $userStats; //Sending statistics to template/view
		$this->view->avatarWidth = 100; //Width of profile image
		$this->view->avatarHeight = 150; //height of Profile image
		$this->view->render('profile/user'); 
	} else {
		header("Location:".ROOT.'members');
	}
    }
}
?>