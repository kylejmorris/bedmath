<?php
echo 'You have been banned until:'.date('g:m M d Y', $this->details[0]['expires']).'<br>';
echo '<b>Reason:</b> '.$this->details[0]['comments'];
?>