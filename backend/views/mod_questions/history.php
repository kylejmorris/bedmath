Search user:<form method="post" onsubmit="location.href = '<?php echo ROOT.'mod/mod_questions/history/1/';?>'+ this.topic.value+'/'+this.user.value; return false;">
  <input type="text" name="user" value="<?php echo $this->user;?>"></input>
  <select id="topic">
      <?php
        if($this->currentTopic['id']!=null) {
            if($this->currentTopic['id']=='anytopic') {
                echo '<option value='.$this->currentTopic['id'].'>'.'*Any topic</option>';
            } else {
                echo '<option value='.$this->currentTopic['id'].'>'.'*'.$this->currentTopic['name'].'</option>';
                 echo '<option value="anytopic">Any topic</option>';
            }
        } else {
            echo '<option value="anytopic">Select topic</option>';
        }
        foreach($this->topics as $topic) {
            echo '<option value='.$topic['cat_id'].'>'.$topic['name'].'</option>';
        }
      ?>
  </select>
  <input type="submit" value="search"></input>
</form>
<?php
echo sizeof($this->questions).' question(s) found'.'<br>';
foreach($this->pagination as $page) {
	echo '<a href='.ROOT.'mod/mod_questions/history/'.str_replace(',', '', $page).'>'.$page.'</a>, '; //Topic 0 = all topics, at least we'll just go with that?
}
?>
<table border=1>
    <th>id</th>
    <th>student</th>
    <th>title</th>
    <th>topic</th>
    <th>time</th>
    <th>bid</th>
    <th>Answers</th>
    <th>published</th>
    <?php
    foreach($this->questions as $question) {
        echo '<tr>';
        echo '<td>' . $question['id'].'</td>';
        echo '<td>' . '<a href='.ROOT.'profile/user/'.$question['asked_by'].'>'.$question['username'].'</a>' . '</td>';
        echo '<td>' . '<a href=' . ROOT . 'review/question/' . $question['id'].'>' . $question['title']. '</a></td>';
        echo '<td>' . $question['topic'].'</td>';
        echo '<td>' . date('M d Y-h:m ', $question['asked_time']).'</a></td>';
        echo '<td>' . $question['bid'] . '</td>';
        echo '<td>' . $question['answer_count'] . '</td>';
        if($question['published']==true) {
            echo '<td>Yes</td>';
        } else {
            echo '<td>No</td>';
        }
        echo '<td><a href='.ROOT.'mod/mod_questions/review/'.$question['id'].'>Review</a></td>';
        echo '<td><a href='.ROOT.'mod/mod_questions/edit/'.$question['id'].'>Edit</a></td>';
        echo '</tr>';
    }
    ?>
</table>

