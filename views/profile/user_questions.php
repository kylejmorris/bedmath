Question Summary
<br><br><br>
Question History
<div id="pagination">
    <?php
        foreach($this->pagination as $page) {
            echo '<a href='.ROOT.'profile/user/'.$this->userId.'/questions/'.str_replace(',', '', $page).'/'.$this->topic.'>'.$page.'</a>';
        }
    ?>
</div
<?php
foreach ($this->questionHistory as $question) {
    echo 'ID: ' . $question['id'] . ' | ';
    echo 'Topic: ' . $question['topic'] . ' | ';
    echo 'Asked: '.date('M d Y', $question['asked_time']).'<br>';
    echo '<a href='.ROOT.'review/question/'.$question['id'].'/>'.$question['title'].'</a><br>';
    echo 'Status: ';
    if ($question['solved_by'] != null) {
        echo 'Solved by: ' . $question['solved_by'];
    } else {
        echo 'Unsolved';
    }
    echo '<br>';
    echo 'Answered '.$question['answer_count'].' time(s)';
    echo '<br><br>';
}
?>
