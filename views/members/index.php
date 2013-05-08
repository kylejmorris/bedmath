<form action="<?php echo ROOT.'search/users/';?>" method=POST>
	<input type="text" name="query" placeholder="Search user..." value="">
	<input type="submit" value="Submit">
</form>
Page: 
<?php
	foreach($this->pagination as $value) {
		echo '<b><a href='.ROOT.'members/page/'.$value.'>'.$value.'</a></b>'.', ';
	}
?>
<br>
<?php
//Running loop on each user, allowing specific user info to be grabbed from $value
foreach($this->userList as $key => $value) { 
	echo '<b>Username:</b> '.'<a href='.ROOT.'profile/user/'.$value['user_id'].'>'.$value['username'].'</a><br>';
	echo $value['user_level'].'<br>';
	echo '<b>Joined: </b>'.date('m-d-Y',$value['join_date']).'<br>';
	echo '<b>User #</b>'.$value['user_id'].'<br>';
	echo '<b>Points:</b>'.$value['points'].'<br>';
	echo '<h1><hr></h1>';
}
?>