<div id="Container" class="clearfix">
    <div id="AccountPortal">
        <div id="Register">
            <form action="<?php echo ROOT . 'mod/mod_questions/runEdit/' . $this->qid; ?>" method="POST">
                <input type="text" name="title" value="<?php echo $this->question['title']; ?>" ></input>
                <select name="topic">
                    <option value="<?php echo $this->question['topic']; ?>">Change topic</option>
                    <?php
                    foreach ($this->topics as $topic) {
                        echo '<option value=' . $topic['cat_id'] . '>' . $topic['name'] . '</option>';
                    }
                    ?>
                </select>
                <textarea type="text" name="full" value="<?php echo $this->question['full']; ?>" rows=8 cols=40><?php echo $this->question['full']; ?></textarea>
                <h2> Bidding details </h2>
                <input type="text" name="bid" value="<?php echo $this->question['bid']; ?>"></input>
                <?php
                if ($this->question['published'] == true) {
                    echo 'Published: <input type=radio name=published value=1 CHECKED>Yes';
                    echo '<input type=radio name=published value=0 >No';
                } else {
                    echo 'Published: <input type=radio name=published value=1>Yes';
                    echo '<input type=radio name=published value=0 CHECKED>No';
                }
                if ($this->question['activated'] == true) {
                    echo 'Activated: <input type=radio name=activated value=1 CHECKED>Yes';
                    echo '<input type=radio name=activated value=0 >No';
                } else {
                    echo 'Activated: <input type=radio name=activated value=1>Yes';
                    echo '<input type=radio name=activated value=0 CHECKED>No';
                }
                ?>
                <input type="submit" value="Edit Question"></input>
            </form>
        </div>
        <div id="Other">
        </div>
    </div>
</div>
