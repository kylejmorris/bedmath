<?php
echo 'State: '.$this->details[0]['state'].'<br>';
echo 'Reported By: '.$this->details[0]['reporter'].'<br>';
echo 'During: '.$this->details[0]['time'].'<br>';
echo 'Reason: '.$this->details[0]['reason'].'<br>';
echo 'Type: '.$this->details[0]['type'].'<br>';
echo 'Evidence: '.$this->details[0]['evidence'].'<br>';
echo 'Comments: '.$this->details[0]['comments'].'<br>';
?>
<a href="<?php echo ROOT.'mod/mod_report/runreport/'.$this->details[0]['id'].'/1';?>">Confirm</a>
<a href="<?php echo ROOT.'mod/mod_report/runreport/'.$this->details[0]['id'].'/2';?>">Deny</a>