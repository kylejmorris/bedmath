<h3>Redemption Summary</h3>
<br>
<?php
echo 'Total Redeem Requests: '.$this->summary['total_requests'].'<br>';
echo 'Paid: '.$this->summary['total_paid'].' (value=$'.$this->summary['cash_paid'].')';
?>
<a href="<?php echo ROOT.'mod/mod_redeem/paid/';?>">View Paid<a><br>
<?php
echo 'Accepted: '.$this->summary['total_accepted'].' (value=$'.$this->summary['cash_accepted'].')';
?>
<a href="<?php echo ROOT.'mod/mod_redeem/accepted/';?>">View Accepted<a><br>
<?php
echo 'Pending: '.$this->summary['total_pending'].' (value=$'.$this->summary['cash_pending'].')';
?>
<a href="<?php echo ROOT.'mod/mod_redeem/pending/';?>">View Pending<a><br>
<?php
echo 'Denied: '.$this->summary['total_denied'].' (value=$'.$this->summary['cash_pending'].')';
?>
<a href="<?php echo ROOT.'mod/mod_redeem/denied/';?>">Denied Requests<a><br>