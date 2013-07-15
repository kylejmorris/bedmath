<?php
echo 'Questions posted: '.$this->summary['total_questions'].'<br>';
echo 'Questions(today): '.$this->summary['asked_today'].'<br>';
echo 'Total answered: '.$this->summary['total_answered'];
?>

<a href="<?php echo ROOT.'mod/mod_questions/history';?>">View questions</a>