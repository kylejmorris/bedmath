<?php
echo 'You have been banned until:'.date('M d Y G:i', $this->details[0]['expires']).'<br>';
echo '<b>Reason:</b> '.$this->details[0]['comments'];
?>