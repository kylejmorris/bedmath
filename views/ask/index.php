<div class="row ask">
		   <form action="<?php echo ROOT . 'ask/runAsk'; ?>" method="POST">
				<div class="column-8 left">
					<input type="text" name="title" value="" placeholder="Title"></input>
					<textarea id="editor" type="text" name="full" value="" onchange="UpdateMath(this.value)" placeholder="Put all the scary math here..."></textarea>
				</div>
				<div class="column-4">
					 <input type="text" name="bid" value="" placeholder="Enter bid amount"></input>
					 <select name="topic">
						<option value="">Select Topic</option>
						<?php
						foreach ($this->topics as $topic) {
							echo '<option value=' . $topic['cat_id'] . '>' . $topic['name'] . '</option>';
						}
						?>
					</select>
				</div>
				<div class="column-11">
				     <input type="submit" class="button small" value="Post Question"></input>
					 <span class="or"> or </span>
					 <a href="<?php echo ROOT;?>questions"> Cancel </a>
				</div>
			</form>
</div>
Bid Buddy!
<?php
$keys = array_keys($this->bidBuddy); //Array of bid buddy topics
for($c=0; $c<sizeof($this->bidBuddy); $c++) {
    echo $keys[$c].': '.$this->bidBuddy[$keys[$c]].'<br>';
}
?>
<script type="text/javascript">
    CKEDITOR.replace( 'full', {
    toolbar: 'Basic',
});
</script>

