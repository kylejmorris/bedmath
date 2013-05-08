<form action="<?php echo ROOT.'search/users/';?>" method=POST>
	<input type="text" name="query" placeholder="Search user..." value="">
	<input type="submit" value="Submit">
</form>
<?php
foreach($this->pagination as $page) {
	echo '<a href='.ROOT.'search/users/'.$this->query.'/'.$page.'>'.$page.'</a>, ';
}
echo '<br>';
foreach($this->users as $value) {
	echo '<b>Username:</b> '.'<a href='.ROOT.'profile/user/'.$value['user_id'].'>'.$value['username'].'</a><br>';
	echo $value['user_level'].'<br>';
	echo '<b>Joined: </b>'.date('m-d-Y',$value['join_date']).'<br>';
	echo '<b>User #</b>'.$value['user_id'].'<br>';
	echo '<b>Points:</b>'.$value['points'].'<br>';
	echo '<hr>';
}
?>