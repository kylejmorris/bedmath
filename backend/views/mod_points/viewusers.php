<?php
for($c=0; $c<sizeof($this->pagination); $c++) {
	echo '<a href='.ROOT.'mod/users/view/'.$this->pagination[$c].'/'.$this->limit.'>'.$this->pagination[$c].'</a>'.', ';
}
echo '<br>';
?>
<table border=1>
<th>id</th>
<th>Username</th>
<th>Points</th>
<th>Earned(Day)</th>
<th>Earned(Week)</th>
<th>Earned(Month)</th>
<th>Earned(Year)</th>
<th>Earned(All Time)</th>
<?php
foreach($this->users as $value) {
	echo '<tr>';
	echo '<td>'.$value['user_id'].'</td>';
	echo '<td>'.$value['username'].'</td>';
	echo '<td>'.$value['points'].'</td>';
	echo '<td>'.$value['earn_day'].'</td>';
	echo '<td>'.$value['earn_week'].'</td>';
	echo '<td>'.$value['earn_month'].'</td>';
	echo '<td>'.$value['earn_year'].'</td>';
	echo '<td>'.$value['earn_all_time'].'</td>';
	echo '<td><a href="'.ROOT.'mod/mod_points/edit/'.$value['user_id'].'">Edit</a></td>';
	echo '</tr>';
}
?>
</table> 