<div class="row ask">
	 <div class="column-11">
		  <?php
			echo 'Title: '.$this->question['title'].'<br>';
			echo 'Asked by: '.$this->question['asked_by'].'<br>';
		  ?>
			<form action="<?php echo ROOT;?>reporting/runquestion" method="POST">
				<select name="reason">
				<?php
					for($c=0; $c<sizeof($this->reasons); $c++) { //Run through each report reason
						echo '<option value='.$this->reasons[$c][0].'>'.$this->reasons[$c][2].'</option>'; //Supplying readson and name to generate list dynamically
					}
				?>
				</select> 
				<textarea name="evidence">Supply evidence/description on the report</textarea>
				<textarea name="comments">Any comments on this?</textarea>
				<input type="hidden" name="content_id" value="<?php echo $this->question['id']; ?>">
				<input type="submit" value="Send" class="button small">
			</form>
	</div>
</div>

