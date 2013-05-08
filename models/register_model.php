<?php
class Register_Model extends Model {
    function __construct() {
        parent::__construct();
	$this->user = new User();
	$this->points = new Points(); 
	$this->image = new Image(); 
    }
    
    //Processing registration info sent from controller. Making log and recording new user in database
    function runRegister($formData) {
       $username = $formData['username'];
       $joined = time(); //Timestamp of when user registered
       $password = $formData['password'];
       $email = $formData['email']; 
       $avatar = 1; //Default avatar ID. This will load avatar image 1 when user is made
       if($formData['invited_by']!=null) {
		$invitedBy = $this->user->nameToId($formData['invited_by']); 
		$this->user->recordInvite($invitedBy); 
		$this->points->addPoints($invitedBy, 25, 10); //Giving 25 points to whom invited the new user, for the reason of inviting!
       }
       $query = "INSERT INTO g0g1_users (username, password, join_date, email, avatar_id, invited_by) VALUES ('$username','$password', '$joined', '$email', '$avatar', '$invitedBy')"; 
       $this->database->query($query); //Inserting new user into database
       
       $newUserId = $this->user->nameToId($username); //Converting newly created user name into the ID it is now associated with
       $this->points->addPoints($newUserId, 10, 9); //Adding 10 points to new user, as a new user registration bonus. 
       
       return $newUserId; //Returning id of new user for usage within controller
	
  }
    
}
?>