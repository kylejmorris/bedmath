<h2>Answer Summary</h2>
<?php
echo 'Answers posted: '.$this->summary['total_answers'].'<br>';
echo 'Posted today: '.$this->summary['posted_today'].'<br>';
?>

<a href="<?php echo ROOT.'mod/mod_answers/history';?>">View Answers</a>