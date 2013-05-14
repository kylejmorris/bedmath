<?php
echo 'Question ID: '.$this->question['id'].'<br>';
echo 'Title: '.$this->question['title'].'<br>';
echo 'Asked by: '.$this->question['asked_by'].'<br>';
?>

<form action="<?php echo ROOT;?>reporting/runquestion" method="POST">
	<select name="reason">
	<?php
		for($c=0; $c<sizeof($this->reasons); $c++) { //Run through each report reason
			echo '<option value='.$this->reasons[$c][0].'>'.$this->reasons[$c][2].'</option>'; //Supplying readson and name to generate list dynamically
		}
	?>
</select> 
<br>
<textarea name="evidence" width="200" height="200">Supply evidence/description on the report</textarea>
<br>
<textarea name="comments" width="200" height="100">Any comments on this?</textarea>
<input type="hidden" name="content_id" value="<?php echo $this->question['id']; ?>">
<br>
<input type="submit" value="Submit">
</form>
