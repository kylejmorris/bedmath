<div class="row ask">
            <form action="<?php echo ROOT . 'account/runEditQuestion/' . $this->qid; ?>" method="POST">
				<div class="column-8 left">
					<input type="text" name="title" value="<?php echo $this->question['title']; ?>" ></input>
					<textarea type="text" name="full" value="<?php echo $this->question['full']; ?>" rows=8 cols=40><?php echo $this->question['full']; ?></textarea>
               </div>
			   <div class="column-4 right">
                               <input type="text" name="bid" value="<?php echo $this->question['bid']; ?>"></input>
				   <select name="topic">
						<option value="<?php echo $this->question['topic']; ?>">Change topic</option>
						<?php
						foreach ($this->topics as $topic) {
							echo '<option value=' . $topic['cat_id'] . '>' . $topic['name'] . '</option>';
						}
						?>
					</select>
				</div>
                <?php
                if ($this->question['published'] == true) {
                    echo 'Published: <input type=radio name=published value=1 CHECKED>Yes';
                    echo '<input type=radio name=published value=0 >No';
                } else {
                    echo 'Published: <input type=radio name=published value=1>Yes';
                    echo '<input type=radio name=published value=0 CHECKED>No';
                }
                ?>
                <input class="button small" type="submit" value="Post Question"></input>
				<span class="or"> or </span>
				<a href="<?php echo ROOT;?>questions"> Cancel </a>
            </form>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'full', {
    toolbar: 'Basic',
});
</script>
