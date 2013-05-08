<?php
echo '<h2>Community Stats:</h2><br>';
echo '<b>Total Points</b>: '.$this->stats['total_points'].'<br>';
echo '<b>Earned Today</b>: '.$this->stats['earned_today'].'<br>';
echo '<b>Lost Today</b>: '.$this->stats['lost_today'].'<br>';
echo '<b>Richest User</b>: '.$this->stats['richest_user'].'<br>';
echo '<a href='.ROOT.'mod/mod_points/viewusers>User Points</a><br>';
echo '<a href='.ROOT.'mod/mod_points/transactions>Transaction History</a>';

?>