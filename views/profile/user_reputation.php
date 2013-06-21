Navigate:
<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/'; ?>">General</a>||
<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/questions'; ?>">Questions</a>||
<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/answers'; ?>">Answers</a>||
<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/reputation'; ?>"><b>Reputation</b></a>
<h3>Reputation Summary</h3>
<?php
echo 'Total Reputation: '.$this->reputationSummary['total_reputation'].'<br>';
?>
<h3>Topic Chart</h3>
<?php
    for($c=0; $c<sizeof($this->reputationSummary['topics']); $c++) {
        if($c<3) {
            echo '<b>'.$this->reputationSummary['topics'][$c][0].': '.$this->reputationSummary['topics'][$c][1].'</b> ';
        } else {
            echo $this->reputationSummary['topics'][$c][0].': '.$this->reputationSummary['topics'][$c][1].'</b> ';
        }
    }
?>
<br>
<br>
<h3>Reputation History</h3>
<div id="pagination">
    <?php
    foreach ($this->pagination as $page) {
        echo '<a href=' . ROOT . 'profile/user/' . $this->userId . '/reputation/' . str_replace(',', '', $page) . '/' . $this->topic . '>' . $page . '</a>';
    }
    ?>
</div>
<?php
foreach($this->reputationHistory as $event) {
    echo 'Topic: '.$event['topic'].' ';
    echo 'User: '.$event['object'].' ';
    echo 'Time: '.date('M d, Y', $event['time']);
    echo 'Amount: '.$event['amount'];
    echo '<br>';
}
?>