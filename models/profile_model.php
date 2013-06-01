<?php
class Profile_Model extends Model {
    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->email = new Email();
        $this->image = new Image();
        $this->reputation = new Reputation();
    }
    
    /*
     * Returns array of general details shown on all of users profile tabs.
     */
    public function getUserDetail($userId) {
        $userDetail = $this->user->getDetailFromId($userId);
        array_push( $userDetail, 'avatar');
        array_push($userDetail, 'reputation');
        $userDetail['reputation'] = $this->reputation->getUserRep($userId);
        $avatarDetails = $this->image->getImageByContent(3, $userDetail['avatar_id']); //Getting avatar image details 
        $userDetail['avatar'] = $avatarDetails['image_name'].'.'.$avatarDetails['file_type']; //Putting together image info to create url for avatar image. 
        return $userDetail;
    }
    
    //Getting statistics about users activity. 
    public function getUserStats($userId) {
	
  }

}
?>