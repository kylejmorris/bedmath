<?php
echo 'Page: ';
foreach($this->pagination as $value) {
	echo '<a href='.ROOT.'mod/mod_users/bans/'.$value.'/'.$this->count.'>'.$value.', </a>';
}
?>
<table border=1>
<th>id</th>
<th>user</th>
<th>created by</th>
<th>created time</th>
<th>expires</th>
<th>comments</th>
<?php
foreach($this->bans as $value) {
	echo '<tr>';
	echo '<td>'.$value['id'].'</td>';
	echo '<td>'.$value['user_id'].'</td>';
	echo '<td>'.$value['created_by'].'</td>';
	echo '<td>'.$value['created_time'].'</td>';
	echo '<td>'.$value['expires'].'</td>';
	echo '<td>'.$value['comments'].'</td>';
	echo '</tr>';
}
?>
</table>