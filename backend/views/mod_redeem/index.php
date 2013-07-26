<h3>Redemption Summary</h3>
<br>
<?php
echo 'Total Redeem Requests: '.$this->summary['total_requests'].'<br>';
echo 'Paid: '.$this->summary['total_paid'].' (value=$'.$this->summary['cash_paid'].')</br>';
echo 'Accepted: '.$this->summary['total_accepted'].' (value=$'.$this->summary['cash_accepted'].')<br>';
echo 'Pending: '.$this->summary['total_pending'].' (value=$'.$this->summary['cash_pending'].')<br>';
?>
<a href="<?php echo ROOT.'mod/mod_redeem/pending/';?>">View Redeem Requests<a>