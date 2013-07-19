<b>Potential:</b>
<?php 
if($this->potential==0) {
	echo 'You have the highest reputation of all tutors who are answering this question right now, consider the odds to be ever in your favor';
} else if($this->potential>=1 && $this->potential<=5) {
	echo $this->potential.' other tutors (who have posted answers to this question) have a higher reputation level for this math topic. <br>Do not fret, you may still be selected for having the best answer, however you may need to go above and beyond those with higher reputation in their name.';
} else if($this->potential>5) {
	echo $this->potential.' other tutors (who have posted answers to this question) have a higher reputation level for this math topic. <br> Your chances of being picked for best answer are quite low, however this is your chance to prove us wrong by giving top-notch support!';
}
?>
<h2>Question</h2>
<?php
echo $this->question['title'].'<br>';
echo 'Title: '.$this->question['full'].'<br>';
echo 'Bid: '.$this->question['bid'].'<br>';
echo 'Asked by: '.$this->question['asked_by'].' on'.date('D m Y', $this->question['asked_time']).'<br>';
?>

<h2>Answer:</h2>
<form action="<?php echo ROOT.'giveanswer/questionrun/'.$this->qid;?>" method="POST">
<textarea name="answer"></textarea>
<br>
<input type="submit" value="Give Answer">
</form>
<script> CKEDITOR.replace( 'answer' ); </script>