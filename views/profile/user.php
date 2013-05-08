<center>
<?php
echo '<h3>'.$this->userDetail['username'].'\'s Profile'.'</h3>'.'<br>';
$joinDate = $this->userDetail['join_date']; //Need to convert date to be readable. 
$joinDate = date('F d, Y', $this->userDetail['join_date']);
echo '<img src='.IMAGE_ROOT.$this->userDetail['avatar'].' width='.$this->avatarWidth.' height='.$this->avatarHeight.'><br>'; //Generating avatar image
echo 'Points: '.$this->userDetail['points'].'<br>';
echo 'Joined on: '.$joinDate.'<br>';
?>
</center>
<?php
/*foreach($this->writingDetail as $key => $value) {
	echo '<b>'.$value['title'].'</b><br>'; //Writing title
	echo date('F d, Y', $value['created']).'<br>'; //Time writing was created
	echo 'Views: '.$value['views'].'<br>';
	echo 'Unlocks: '.$value['unlock_count'].'<br>';
}
?>
<h2>Statistics</h2>
<?php
echo '<b>Writing posted: </b>'.$this->userStats['content_count'].'<br>';
echo '<b>Total content views: </b>'.$this->userStats['total_views'].'<br>';
echo '<b>Total content unlocks: </b>'.$this->userStats['total_unlocks'].'<br>';
?>
<a href="<?php echo ROOT.'reporting/user/'.$this->userDetail['user_id'];?>">Report User</a>
*/