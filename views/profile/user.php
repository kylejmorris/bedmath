<?php
echo '<h3>'.$this->userDetail['username'].'\'s Profile'.'</h3>'.'<br>';
$joinDate = $this->userDetail['join_date']; //Need to convert date to be readable. 
$joinDate = date('F d, Y', $this->userDetail['join_date']);
echo '<img src='.IMAGE_ROOT.$this->userDetail['avatar'].' width='.$this->avatarWidth.' height='.$this->avatarHeight.'><br>'; //Generating avatar image
echo 'Joined on: '.$joinDate.'<br>';
echo 'Reputation: '.$this->userDetail['reputation'];
?>

