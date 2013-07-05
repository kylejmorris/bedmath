<center>
    <h2>Question</h2>
    <?php
    echo '<b>Title</b>: ' . $this->question['title'] . '<br>';
    echo '<b>Question</b>: ' . $this->question['full'] . '<br>';
    echo '<b>Bid</b>: ' . $this->question['bid'] . '<br>';
    echo '<b>Asked by</b>: ' . $this->question['asked_by'] . ' on ' . date('D m Y', $this->question['asked_time']) . '<br>';
    echo '<a href=' . ROOT . 'reporting/question/' . $this->qid . '>Report</a>';
    ?>
    <br>
    <a href="<?php echo ROOT . 'giveanswer/question/' . $this->qid; ?>">Answer!</a>
</center>
<h2>Answers</h2>
<?php
foreach ($this->answers as $answer) {
    echo '<b>Answer ID:</b> ' . $answer['id'] . '<br>';
    echo '<b>Tutor:</b> ' . $answer['user'] . '<br>';
    echo '<a href=' . ROOT . 'profile/user/' . $answer['user_id'] . '>';
    $answer['avatar']->render();
    echo '</a>'; //the render() method echoes, therefor I can't echo it within this main view page.
    echo '<b>Reputation:</b>' . $answer['reputation'] . '<br>';
    echo '<b>Answer:</b> ' . $answer['full_text'] . '<br>';
    echo '<b>Posted:</b> ' . date('M d Y', $answer['time']) . '<br>';
    if ($this->user == $this->question['asked_by']) {
        echo '<a href=' . ROOT . 'confirm/question/' . $this->question['id'] . '/' . $answer['id'] . '>Select Answer!</a><br><br>';
    }
    echo '<center>';
    foreach($answer['replies'] as $reply) {
        echo '<b>'.$reply['username'].'</b> replied: ';
        echo $reply['full_text'].'<br>';
    }
    echo '<form action='.ROOT.'givereply/questionRun/'.$answer['question_id'].'/'.$answer['id'].' method="POST">';
    echo '<textarea name="full_text" rows="2" cols="25" placeholder="Quick reply..."></textarea>';
    echo '<input type="submit" value="post"></input>';
    echo '</form>';
    echo '<a href='.ROOT.'givereply/question/'.$answer['question_id'].'/'.$answer['id'].'>Full Reply</a><br>';
    echo '</center>';
    echo '<a class="button" href='.ROOT.'review/replies/'.$answer['question_id'].'/'.$answer['id'].'>All Replies...</a><br><br><br>';
}
?>

