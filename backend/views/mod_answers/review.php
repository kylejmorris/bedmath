<?php
echo '<a class="button normal" href='.ROOT.'mod/mod_answers/edit/'.$this->answerSummary['id'].' >Edit Answer</a><br><br>';
?>
<h2>Answer summary</h2>
<?php
echo 'Answer id: '.$this->answerSummary['id'].'<br>';
echo 'Question id: '.'<a href='.ROOT.'mod/mod_questions/review/'.$this->answerSummary['question_id'].'>'.$this->answerSummary['question_id'].'</a><br>';
echo 'Posted by: '.'<a href='.ROOT.'profile/user/'.$this->answerSummary['user'].'>'.$this->answerSummary['username'].'</a>(id'.$this->answerSummary['user'].')<br>';
echo 'Time posted: '. date('M d Y', $this->answerSummary['time']).'<br>';
if($this->answerSummary['version']>1) {
    echo 'Version: '.$this->answerSummary['version'].'(last edit time: '.date('M d Y', $this->answerSummary['edit_time']).')<br>';
} else {
    echo 'Version: '.$this->answerSummary['version'].'(last edit time: never)<br>';
}
echo 'Published: '. $this->answerSummary['published'].'<br>';
echo 'Accepted: '.$this->answerSummary['accepted'].'<br>';
echo 'Activated: '.$this->answerSummary['activated'].'<br>';
?>

<h3>Replies</h3>
<?php
foreach($this->replies as $reply) {
    echo '<i>'.date('M d Y-G:m', $reply['time']).'</i>:<a href='.ROOT.'profile/user/'.$reply['user_id'].'>'.$reply['username'].'</a>: ';
    echo $reply['full_text'].'<br>';
}
?>