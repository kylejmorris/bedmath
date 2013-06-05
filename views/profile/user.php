<?php
echo '<h3>'.$this->userDetail['username'].'\'s Profile'.'</h3>'.'<br>';
$joinDate = $this->userDetail['join_date']; //Need to convert date to be readable. 
$joinDate = date('F d, Y', $this->userDetail['join_date']);
echo '<img src='.IMAGE_ROOT.$this->userDetail['avatar'].' width='.$this->avatarWidth.' height='.$this->avatarHeight.'><br>'; //Generating avatar image
echo 'Joined on: '.$joinDate.'<br>';
echo 'Reputation: '.$this->userDetail['reputation'].'<br>';
echo 'Questions asked: '.$this->userDetail['questions_asked'].'<br>';
echo 'Answers posted: '.$this->userDetail['answers_posted'].'<br>';
?>
<br>
<h2>Best topics</h2>
<br>
<?php
foreach($this->userDetail['top_topics'] as $topic) {
    echo $topic[0].' with ';
    echo $topic[1].' reputation'.'<br>';
}
?>
<a href="<?php echo ROOT.'profile/user/'.$this->userDetail['user_id'].'/questions';?>">Questions</a>||
<a href="<?php echo ROOT.'profile/user/'.$this->userDetail['user_id'].'/answers';?>">Answers</a>||
<a href="<?php echo ROOT.'profile/user/'.$this->userDetail['user_id'].'/reputation';?>">Reputation</a>


