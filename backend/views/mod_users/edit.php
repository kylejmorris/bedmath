
<form action='../runedit/<?php echo $this->details['user_id'];?>' method='POST'>
<?php
echo 'Username: <input type=text name=username value='.$this->details['username'].'><br>';
echo 'Email: <input type=text name=email value='.$this->details['email'].'><br>';
echo 'Password: <input type=password placeholder="New Password" name=password value=""><br>';
if($this->details['activated']==true) {
	echo 'Activated: <input type=radio name=activated value=1 CHECKED>Yes';
echo '<input type=radio name=activated value=0 >No<br>';
} else {
	echo 'Activated: <input type=radio name=activated value=1>Yes';
	echo '<input type=radio name=activated value=0 CHECKED>No<br>';
}
?>
<select name='user_level'>
<?php
for($c=0; $c<6; $c++) {
$userLevels = array('Banned', 'Public', 'Registered', 'Moderator', 'Administrator', 'Super Administrator');
	if((int)$this->details['user_level']==$c) {
		$selected = 'SELECTED';
		echo 'test';
	} else {
		$selected = '';
	}
	echo '<option name=user_level value='.$c.' '.$selected.'>'.$userLevels[$c].'</option>';
}
?>
</select>
<br>
<input type="submit" value="Update">
</form>