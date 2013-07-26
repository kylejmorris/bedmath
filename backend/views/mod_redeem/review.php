<h3>Reviewing Pending Request</h3>
<i>Make sure the checks are met, and everything seems legitimate</i>
<br>
<?php
echo 'id: '.$this->details['id'].'<br>';
echo 'Request Code: '.$this->details['request_code'].'<br>';
echo 'User Id: '.'<a href='.ROOT.'profile/user/'.$this->details['user_id'].'>'.$this->details['user_id'].'</a><br>';
echo 'amount: '.$this->details['amount'].'<br>';
echo 'time: '.date('M d Y-G:i', $this->details['time']).'<br>';
echo 'status: '.$this->details['status'].'<br>';
echo 'User banned?: '.$this->details['is_banned'].'<br>';
echo 'Has been banned?: '.$this->details['has_been_banned'].'<br>';
echo 'Questions Posted: '.$this->details['total_questions'].'<br>';
echo 'Answers Posted: '.$this->details['answer_count'].'<br>';
echo 'Email Activated?: '.$this->details['activated'].'<br>';

echo '<br><a href='.ROOT.'mod/mod_redeem/reviewaccepted/'.$this->details['id'].'>CONFIRM</a>';
echo '<br><br><br>';
echo '<a href='.ROOT.'mod/mod_redeem/reviewdenied/'.$this->details['id'].'>DENY</a>';
?>
