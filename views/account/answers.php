<div id="pagination">
    <?php
    foreach ($this->pagination as $page) {
        echo '<a href=' . ROOT . 'account/answers/' . str_replace(',', '', $page).'>' . $page . '</a>';
    }
    ?>
</div>
<?php
foreach($this->answers as $answer) {
    echo 'Question: '.'<a href='.ROOT.'/review/question/'.$answer['question_id'].'>'.$answer['question_title'].'</a><br>';
    echo 'Posted on: '.date('M d Y', $answer['time']);
    if($answer['accepted']==true) {
        echo 'Accepted';
    }
    echo '<br>';
    echo '<a href='.ROOT.'account/editanswer/'.$answer['id'].'>edit</a>';
    echo '<br><br>';
}
?>