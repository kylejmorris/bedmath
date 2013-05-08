You are about to confirm the answer posted by <?php echo $this->tutorName; ?>.
<br>
If this is the answer that helped you most, continue below!
<form action="<?php echo ROOT.'confirm/run/';?>" method=POST>
<input type="submit" value="Confirm!"></input>
<input type="hidden" name=question_id value="<?php echo $this->answerDetail['question_id'];?>"></input>
<input type="hidden" name=answer_id value="<?php echo $this->answerDetail['id'];?>"></input>
</form>