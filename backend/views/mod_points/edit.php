<?php
echo $this->details['username'];
?>
<form action='../runedit' method='POST'>
Points <input type="text" name='points' value='<?php echo $this->details['points'];?>'>
	<input type="hidden" name="user_id" value='<?php echo $this->details['user_id'];?>'>
<br>
<input type="submit" value="Update">
</form>