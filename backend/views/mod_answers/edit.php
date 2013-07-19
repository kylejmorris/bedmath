<div id="Container" class="clearfix">
    <div id="AccountPortal">
        <div id="Register">
            <form action="<?php echo ROOT . 'mod/mod_answers/runEdit/' . $this->id; ?>" method="POST">
                <textarea type="text" name="full_text" value="<?php echo $this->answer['full_text']; ?>" rows=8 cols=40><?php echo $this->answer['full_text']; ?></textarea>
                <?php
                if ($this->answer['published'] == true) {
                    echo 'Published: <input type=radio name=published value=1 CHECKED>Yes';
                    echo '<input type=radio name=published value=0 >No';
                } else {
                    echo 'Published: <input type=radio name=published value=1>Yes';
                    echo '<input type=radio name=published value=0 CHECKED>No';
                }
                if($this->answer['activated']==true) {
                    echo 'Activated: <input type=radio name=activated value=1 CHECKED>yes';
                    echo '<input type=radio name=activated value=0 >No';
                } else {
                    echo 'Activated: <input type=radio name=activated value=1>Yes';
                    echo '<input type=radio name=activated value=0 CHECKED>No';
                }
                ?>
                
                <input type="submit" value="Edit Answer"></input>
            </form>
        </div>
        <div id="Other">
        </div>
    </div>
</div>
