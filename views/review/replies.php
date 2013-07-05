<?php
echo '<b>Title</b>: ' . $this->question['title'] . '<br>';
echo '<b>question</b>: ' . $this->question['full'] . '<br>';
echo '<b>Bid</b>: ' . $this->question['bid'] . '<br>';
echo '<b>Asked by</b>: ' . $this->question['asked_by'] . ' on ' . date('D m Y', $this->question['asked_time']) . '<br>';
echo '<a href=' . ROOT . 'reporting/question/' . $this->qid . '>Report</a>';
?>
<br><br><br><br><br>
<center>
<h3>Replies</h3>
<?php
echo '<a class="button" href='.ROOT.'givereply/question/'.$this->answer['question_id'].'/'.$this->answer['id'].'>Reply?</a><br>';
$count = 0;
foreach($this->replies as $reply) {
    echo '#'.$count.' ';
    $count++;
    echo '<b>'.$reply['username'].'</b><br>';
    echo $reply['full_text'].'<br>';
    echo date('M d Y', $reply['time']).'<br>';
    echo '<br>';
}
echo '<a class="button" href='.ROOT.'givereply/question/'.$this->answer['question_id'].'/'.$this->answer['id'].'>Reply?</a><br>';
echo '<a class="button" href='.ROOT.'review/question/'.$this->question['id'].'>Main Summary...</a><br>';
?>
</center>