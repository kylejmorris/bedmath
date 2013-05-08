<?php 
echo '<h2>Community statistics:</h2>';
echo 'Total Users: '.$this->stats['total_users'].'<br>';
echo 'Activated: '.$this->stats['total_activated'].'<br>';
echo 'Banned: '.$this->stats['total_banned'].'<br>';
echo '<a href='.ROOT.'mod/mod_users/view/ >View Users</a><br>';
echo '<a href='.ROOT.'mod/mod_users/bans>Ban History</a>';
?>