<style>
#question_answered {
	background-color: #f1fef2;
}
#question_unanswered {
	background-color: #ffffff;
}
</style>

<div id="Container" class="clearfix">
<div id="Questions">
Page:
<?php
if($this->topic==null) {
    $this->topic = 0;
}
foreach($this->pagination as $page) {
	if($this->topic!=null) {
		echo '<a href='.ROOT.'questions/view/'.str_replace(',', '', $page).'/'.$this->topic.'/'.$this->bid.'/>'.$page.'</a> ';
	} else {
		echo '<a href='.ROOT.'questions/view/'.str_replace(',', '', $page).'/0/'.$this->bid.'/>'.$page.'</a> '; //Topic 0 = all topics, at least we'll just go with that?
	}
}

foreach($this->questions as $question) {
	if($question['answer_count']==0) { //If question has no answers, highlight it as priority. 
		echo '<div id=question_answered>';
                $question['avatar']->render(); //Creating avatar image
		echo '#'.$question['id'].' ';
		echo 'Topic: '.$question['topic'].'<br>';
		echo '<a href='.ROOT.'review/question/'.$question['id'].'><b>'.$question['title'].'</b></a><br>';
		echo 'Bid: '.$question['bid'].'<br>';
		echo 'Answers: '.$question['answer_count'].'<br>';
		echo 'Posted by: '.$question['asked_by'].' on '.date('M d, Y', $question['asked_time']).'<br>';
		echo '<a href='.ROOT.'giveanswer/question/'.$question['id'].'>Answer</a><br>';
		echo '<a href='.ROOT.'reporting/question/'.$question['id'].'>Report</a>';
		echo '</div>';
	} else {
		echo '<div id=question_unanswered>';
                $question['avatar']->render();
		echo '#'.$question['id'].' ';
		echo '<a href='.ROOT.'review/question/'.$question['id'].'><b>'.$question['title'].'</b></a><br>';
		echo 'Bid: '.$question['bid'].'<br>';
		echo 'Answers: '.$question['answer_count'].'<br>';
		echo 'Posted by: '.$question['asked_by'].' on '.date('M d, Y', $question['asked_time']).'<br>';
		echo '<a href='.ROOT.'giveanswer/question/'.$question['id'].'>Answer</a><br>';
		echo '<a href='.ROOT.'reporting/question/'.$question['id'].'>Report</a>';
		echo '</div>';
	}
	echo '<br><br>';
}
?>
</div>
<div id="Side">
	<select id=topics onChange=sortTopics(this.value)>
<?php
	echo '<option value=0>'.'Select Topic'.'</option>';
	foreach($this->topics as $topic) {
		echo '<option value='.$topic['cat_id'].'>'.$topic['name'].'</option>';
	}
?>
</select>
<a href="<?php echo ROOT.'ask/';?>" class="button ">Ask Question</a>
</div>
</div>

<script type="text/javascript">
function sortTopics(topic) {
	location.href="<?php echo ROOT.'questions/view/1/';?>" + topic + "<?php echo '/'.$this->bid;?>";
}
</script>