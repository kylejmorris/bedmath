
<h2>Points Analysis</h2>
<?php
	echo 'You currently have '.'<b>'.$this->pointStats['current'].'</b>'.' points<br>';
	echo 'Total earnings (Day): '.$this->pointStats['day'].'<br>'; 
	echo 'Total earnings (Week): '.$this->pointStats['week'].'<br>'; 
	echo 'Total earnings (Month): '.$this->pointStats['month'].'<br>'; 
	echo 'Total earnings (Year): '.$this->pointStats['year'].'<br>'; 
	echo 'Total earnings (All time): '.$this->pointStats['all_time'].'<br>'; 
	echo '<b>Leaderboard Rank: #'.$this->pointStats['rank'].'</b><br>'; 
?>
<table border=1>
<?php
	
	echo '<th>Transaction ID</th>';
	echo '<th>Type</th>';
	echo '<th>Description</th>';
	echo '<th>Amount</th>';
	echo '<th>Sender/Receiver</th>';
	echo '<th>Date</th>';
?>

<h3>Sort transactions</h3>
<p><b>Since:</b></p>
<a href="<?php echo ROOT.'account/points/day/';?>">today</a> || 
<a href="<?php echo ROOT.'account/points/week/';?>">week</a> ||
<a href="<?php echo ROOT.'account/points/month/';?>">month</a> ||
<a href="<?php echo ROOT.'account/points/year/';?>">year</a> ||
<a href="<?php echo ROOT.'account/points/all_time/';?>">all time</a>
<br>
<p><b>Transaction type:</b></p>
<?php
//Generating links that sort by transaction types
foreach($this->types as $key => $value) {
	echo '<a href='.ROOT.'account/points/'.$this->since.'/'.$value['type_id'].'>'.$value['name'].'</a> || ';
}
?>
<br>
<h4><i> Glorious unstyled html table containing transaction info!</i></h4>
<?php
	$c = sizeof($this->pointsHistory)-1; //Getting count value to go down from 
	for($c; $c>=0; $c--) { //Counting down to display transactions from newest to oldest
		echo '<tr>';
		echo '<td>'.$this->pointsHistory[$c]['transaction_id'].'</td>';
		echo '<td>'.$this->pointsHistory[$c]['transaction_type'].'</td>';
		echo '<td>'.$this->pointsHistory[$c]['description'].'</td>';
		echo '<td>'.$this->pointsHistory[$c]['points'].'</td>';
		echo '<td>'.$this->pointsHistory[$c]['object'].'</td>';
		echo '<td>'.date('M d, Y', $this->pointsHistory[$c]['time']).'</td>';
		echo '<tr>';
	}
?>
</table> 