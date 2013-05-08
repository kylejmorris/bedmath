<?php
class Profile_Model extends Model {
    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->email = new Email();
        $this->image = new Image();
        $this->writing = new Writing();
    }
    
    //Getting details about user specifically, and returning 
    public function getUserDetail($userId) {
        $userDetail = $this->user->getDetailFromId($userId);
        array_push( $userDetail, 'avatar');
        $avatarDetails = $this->image->getImageByContent(3, $userDetail['avatar_id']); //Getting avatar image details 
        $userDetail['avatar'] = $avatarDetails['image_name'].'.'.$avatarDetails['file_type']; //Putting together image info to create url for avatar image. 
        return $userDetail;
    }
    
    //Getting statistics about users activity. 
    public function getUserStats($userId) {
	$writingDetail = $this->writing->getDetailBy('publisher_id', $userId);
	$stats = array('content_count', 'total_views', 'total_unlocks');
	$stats['content_count'] = sizeof($writingDetail); //Getting content by specific user and returning row count, to get total amount
	foreach($writingDetail as $key => $value) {
		$stats['total_views']+=$value['views'];
		$stats['total_unlocks']+=$value['unlock_count'];
	}
	return $stats; 
  }
  

    public function runEmail() {
        $this->email->generateDefaultMail(2, 3);
    }

}
?>