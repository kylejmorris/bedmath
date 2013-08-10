<div class="row ask">
            <form action="<?php echo ROOT . 'account/runEditAnswer/' . $this->qid; ?>" method="POST">
				<div class="column-8 left">
					<textarea type="text" name="full_text" value="<?php echo $this->question['full']; ?>" rows=8 cols=40><?php echo $this->answer['full_text']; ?></textarea>
               </div>
				<div class="column-11">
					 <?php
						if ($this->answer['published'] == true) {
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
				</div>
			</form>
</div>
<script type="text/javascript">
    CKEDITOR.replace( 'full_text', {
    toolbar: 'Basic',
});
</script>
