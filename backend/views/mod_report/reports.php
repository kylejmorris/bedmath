<table border=1>
<th>id</th>
<th>state</th>
<th>type</th>
<th>content_id</th>
<th>reporter</th>
<th>time</th>
<th>reason</th>
<?php
foreach($this->pagination as $page) {
	echo '<a href='.ROOT.'mod/mod_report/reports/'.str_replace(',', '', $page).'>'.$page.'</a>, '; //Topic 0 = all topics, at least we'll just go with that?
}
foreach($this->reports as $value) {
	echo '<tr>';
	echo '<td>'.$value['id'].'</td>';
	echo '<td>'.$value['state'].'</td>';
	echo '<td>'.$value['type'].'</td>';
	echo '<td>'.$value['content_id'].'</td>';
	echo '<td>'.$value['reporter'].'</td>';
	echo '<td>'.$value['reason'].'</td>';
	echo '<td>'.$value['time'].'</td>';
	echo '<td><a href='.ROOT.'mod/mod_report/review/'.$value['id'].'>Review</a></td>';
	echo '</tr>';
}
?>
</table>