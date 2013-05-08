<h2>Stats</h2> 
<?php
echo 'Total Writing: '.$this->writingStats['writing_count'].'<br>';
echo 'Pending: '.$this->writingStats['pending_count'].'<br>';
echo 'Published: '.$this->writingStats['published_count'].'<br>';
echo 'Total Views: '.$this->writingStats['total_views'].'<br>';
echo 'Total Unlock: '.$this->writingStats['total_unlocks'].'<br>';
?>

<h2>Writing history</h2>
<table border=1>
<th>ID</th>
<th>Title</th>
<th>Content Type</th>
<th>Earn Type</th>
<th>Category</th>
<th>Date</th>
<th>Publishing</th>
<th>Status</th>
<th>Earned</th>
<th>Views</th>
<th>Unlocks</th>
<?php
	foreach($this->detail as $value) {
		echo '<tr>'; 
		echo '<td>'.$value['content_id'].'</td>';
		echo '<td>'.'<a href='.ROOT.'read/writing/'.$value['content_id'].'>'.$value['title'].'</a>'.'</td>';
		echo '<td>'.$value['type'].'</td>';
		echo '<td>'.$value['earn_type'].'</td>';
		echo '<td>'.$value['category'].'</td>';
		echo '<td>'.$value['created'].'</td>';
		echo '<td>'.$value['published'].'</td>';
		echo '<td>'.$value['activated'].'</td>';
		echo '<td>'.$value['total_earned'].'</td>';
		echo '<td>'.$value['views'].'</td>';
		echo '<td>'.$value['unlock_count'].'</td>';
		echo '<td>'.'<a href='.ROOT.'account/writing/edit/'.$value['content_id'].'>'.'Edit'.'</a>'.'</td>';
		echo '</tr>'; 
	}
?>
</table> 