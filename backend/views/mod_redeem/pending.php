<h3>Pending Redeem Requests</h3>
<i>These have not yet been reviewed. Please review them carefully before accepting!</i>
<br>
Pages: 
<?php
foreach($this->pagination as $page) {
	echo '<a href='.ROOT.'mod/mod_redeem/pending/'.str_replace(',', '', $page).'>'.$page.'</a> '; 
}
?>
<table border=1>
<th>id</th>
<th>Request Code</th>
<th>User</th>
<th>Amount</th>
<th>Time</th>
<th>Status</th>
<?php
foreach($this->requests as $request) {
	echo '<tr>';
	echo '<td>'.$request['id'].'</td>';
        echo '<td>'.$request['request_code'].'</td>';
        echo '<td>'.'<a href='.ROOT.'profile/user/'.$request['user_id'].'>'.$request['username'].'</a></td>';
        echo '<td>'.$request['amount'].'</td>';
        echo '<td>'.date('M d Y-G:i',$request['time']).'</td>';
        echo '<td>'.$request['status'].'</td>';
        echo '<td><a href='.ROOT.'mod/mod_redeem/review/'.$request['id'].'>Review</a></td>';
	echo '</tr>';
}
?>
</table>
