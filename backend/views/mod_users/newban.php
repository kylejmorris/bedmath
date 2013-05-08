<?php
echo 'Username: '.$this->details['username'].'<br>';
?>
<form action='../runnewban/<?php echo $this->details['user_id'];?>' method='POST'>
	<select name='length'>
		<option name='length' value='minute'>1 Minute</option>
		<option name='length' value='hour'>1 Hour</option>
		<option name='length' value='1day'>1 Day</option>
		<option name='length' value='3days'>3 Days</option>
		<option name='length' value='7days'>7 Days</option>
		<option name='length' value='14days'>14 Days</option>
		<option name='length' value='1month'>1 Month</option>
		<option name='length' value='3months'>3 Months</option>
		<option name='length' value='6months'>6 Months</option>
		<option name='length' value='1year'>1 Year</option>
		<option name='length' value='forever'>Forever</option>
	</select>
	<br>
	<textarea rows="5" cols="25" name="comments"></textarea>
	<br>
	<input type="submit" value="Ban!">
</form>