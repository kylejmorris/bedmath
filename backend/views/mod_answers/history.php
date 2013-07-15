Search user:<form method="post" onsubmit="location.href = '<?php echo ROOT.'mod/mod_answers/history/1/';?>'+this.user.value; return false;">
  <input type="text" name="user" value="<?php echo $this->user;?>"></input>
  <input type="submit" value="search"></input>
</form>
<?php
echo sizeof($this->answers).' answers(s) found'.'<br>';
foreach($this->pagination as $page) {
	echo '<a href='.ROOT.'mod/mod_answers/history/'.str_replace(',', '', $page).'>'.$page.'</a>, '; //Topic 0 = all topics, at least we'll just go with that?
}
?>
<table border=1>
    <th>id</th>
    <th>question_id</th>
    <th>user</th>
    <th>time</th>
    <th>accepted</th>
    <th>published</th>
    <th>activated</th>
    <?php
    foreach($this->answers as $answer) {
        echo '<tr>';
        echo '<td>' . $answer['id'].'</td>';
        echo '<td>' . '<a href='.ROOT.'review/question/'.$answer['question_id'].'>'.$answer['question_id'].'</a></td>';
        echo '<td>' . '<a href='.ROOT.'profile/user/'.$answer['user'].'>'.$answer['username'].'</a>' . '</td>';
        echo '<td>' . date('M d Y-h:m ', $answer['time']).'</a></td>';
        echo '<td>' . $answer['accepted'].'</td>';
        echo '<td>' . $answer['published'].'</td>';
        echo '<td>' . $answer['activated'].'</td>';
        echo '<td><a href='.ROOT.'mod/mod_answers/review/'.$answer['id'].'>Review</a></td>';
        echo '<td><a href='.ROOT.'mod/mod_answers/edit/'.$answer['id'].'>Edit</a></td>';
        echo '</tr>';
    }
    ?>
</table>

