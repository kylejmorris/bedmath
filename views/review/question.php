<center>
<h2>Question</h2>
<?php
echo '<b>Title</b>: '.$this->question['title'].'<br>';
echo '<b>Title</b>: '.$this->question['full'].'<br>';
echo '<b>Bid</b>: '.$this->question['bid'].'<br>';
echo '<b>Asked by</b>: '.$this->question['asked_by'].' on '.date('D m Y', $this->question['asked_time']).'<br>';
echo '<a href='.ROOT.'reporting/question/'.$this->qid.'>Report</a>';
?>
<br>
<a href="<?php echo ROOT.'giveanswer/question/'.$this->qid; ?>">Answer!</a>
</center>
<h2>Answers</h2>
<?php
foreach($this->answers as $answer) {
	echo '<b>Answer ID:</b> '.$answer['id'].'<br>';
	echo '<b>Tutor:</b> '.$answer['user'].'<br>';
	echo '<b>Answer:</b> '.$answer['full_text'].'<br>';
	echo '<b>Posted:</b> '.date('M d Y', $answer['time']).'<br>';
	echo '<b>Votes:</b> '.$answer['votes'].'<br>';
    if($this->user==$this->question['asked_by']) {
        echo '<a href='.ROOT.'confirm/question/'.$this->question['id'].'/'.$answer['id'].'>Select Answer!</a><br><br>';

    }
}
?>

