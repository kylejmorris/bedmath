<style>
#question_answered {
	background-color: #f1fef2;
}
#question_unanswered {
	background-color: #ffffff;
}
</style>

<?php
foreach($this->pagination as $page) {
	echo '<a href='.ROOT.'account/questions/'.$page.'>'.$page.'</a>, '; //Topic 0 = all topics, at least we'll just go with that?
}

foreach($this->questions as $question) {
	if($question['answer_count']==0) { //If question has no answers, highlight it as priority. 
		echo '<div id=question_answered>';
		echo '#'.$question['id'].' ';
		echo 'Topic: '.$question['topic'].'<br>';
		echo '<a href='.ROOT.'review/question/'.$question['id'].'><b>'.$question['title'].'</b></a><br>';
		echo 'Bid: '.$question['bid'].'<br>';
		echo 'Answers: '.$question['answer_count'].'<br>';
		echo 'Posted by: '.$question['asked_by'].' on '.date('M d, Y', $question['asked_time']).'<br>';
		echo '<a href='.ROOT.'account/editquestion/'.$question['id'].'>Edit</a>';
		echo '</div>';
	} else {
		echo '<div id=question_unanswered>';
		echo '#'.$question['id'].' ';
		echo '<a href='.ROOT.'review/question/'.$question['id'].'><b>'.$question['title'].'</b></a><br>';
		echo 'Bid: '.$question['bid'].'<br>';
		echo 'Answers: '.$question['answer_count'].'<br>';
		echo 'Posted by: '.$question['asked_by'].' on '.date('M d, Y', $question['asked_time']).'<br>';
		echo '<a href='.ROOT.'account/editquestion/'.$question['id'].'>Edit</a>';
		echo '</div>';
	}
	echo '<br><br>';
}
?>
