<?php
echo 'State: '.$this->details['state'].'<br>';
echo 'Reported By: '.$this->details['reporter'].'<br>';
echo 'During: '.$this->details['time'].'<br>';
echo 'Reason: '.$this->details['reason'].'<br>';
echo 'Type: '.$this->details['type'].'<br>';
echo 'Evidence: '.$this->details['evidence'].'<br>';
echo 'Comments: '.$this->details['comments'].'<br>';
?>
<a href="<?php echo ROOT.'mod/mod_report/runreport/'.$this->details['id'].'/confirmed';?>">Confirm</a>
<a href="<?php echo ROOT.'mod/mod_report/runreport/'.$this->details['id'].'/denied';?>">Deny</a>