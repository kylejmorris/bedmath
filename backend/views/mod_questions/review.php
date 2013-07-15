<?php
echo '<a class="button normal" href='.ROOT.'mod/mod_questions/edit/'.$this->questionSummary['id'].' >Edit Question</a><br><br>';
?>
<h3>Summary</h3>
<?php
echo '<a href='.ROOT.'review/question/'.$this->questionSummary['id'].'>View Live Question</a><br>';
echo '<b>Question id: </b>'.$this->questionSummary['id'].'<br>';
if($this->questionSummary['solved']==true) {
    echo '<b>SOLVED</b><br>';
} else {
    echo 'Unsolved<br>';
}
echo '<b>Asked by: </b>'.$this->questionSummary['asked_by_name'].' (ID'.$this->questionSummary['asked_by'].')'.'<br>';
echo '<b>Asked time: </b>'.date('M d Y-h:m', $this->questionSummary['asked_time']).'<br>';
echo '<b>Title: </b>'.$this->questionSummary['title'].'<br>';
echo '<b>Topic: </b>'.$this->questionSummary['topic'].'<br>';
echo '<b>Bid: </b>'.$this->questionSummary['bid'].'<br>';
echo '<b>Answers: </b>'.$this->questionSummary['answer_count'].'<br>';
echo '<b>Version: </b>'.$this->questionSummary['version'].'<br>';
if($this->questionSummary['published']==true) {
    echo '<b>Published:</b> yes<br>';
} else {
    echo '<b>Published:</b> no<br>';
}
echo '<b>Question text: </b>'.$this->questionSummary['full'].'<br>';
?>

<h3>Answers</h3>
<table border="1">
<th>User</th>
<th>time</th>
<th>replies</th>
<?php
foreach($this->answers as $answer) {
    echo '<tr>';
    echo '<td>'.$answer['username'].'</td>';
    echo '<td>'.date('M d Y', $answer['time']).'</td>';
    echo '<td>'.$answer['reply_count'].'</td>';
    echo '<td><a href='.ROOT.'mod/mod_answers/review/'.$answer['id'].'>Review</a></td>';
    echo '</tr>';
}
?>
</table>