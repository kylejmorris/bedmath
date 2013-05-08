<?php
for($c=0; $c<sizeof($this->pagination); $c++) {
	echo '<a href='.ROOT.'mod/mod_users/view/'.$this->pagination[$c].'/'.$this->limit.'>'.$this->pagination[$c].'</a>'.', ';
}
echo '<br>';
?>
<table border=1>
<th>id</th>
<th>Username</th>
<th>Email</th>
<th>Activated</th>
<th>User Level</th>
<th>Invited by</th>
<th>Invites</th>
<?php
foreach($this->users as $value) {
	echo '<tr>';
	echo '<td>'.$value['user_id'].'</td>';
	echo '<td>'.$value['username'].'</td>';
	echo '<td>'.$value['email'].'</td>';
	echo '<td>'.$value['activated'].'</td>';
	echo '<td>'.$value['user_level'].'</td>';
	echo '<td>'.$value['invited_by'].'</td>';
	echo '<td>'.$value['invites'].'</td>';
	echo '<td><a href='.ROOT.'mod/mod_users/edit/'.$value['user_id'].'>Manage</a></td>';
	echo '<td><a href='.ROOT.'mod/mod_users/newban/'.$value['user_id'].'>Ban</a></td>';
	echo '</tr>';
}
?>
</table> 