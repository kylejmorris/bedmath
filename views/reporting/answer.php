<div class="row ask">
	 <div class="column-11">
		  <?php
			echo 'Posted by: '.$this->answer['username'].'<br>';
                        echo 'Content: '.$this->answer['full_text'];
		  ?>
			<form action="<?php echo ROOT;?>reporting/runanswer" method="POST">
				<select name="reason">
				<?php
                                    echo '<option value="">Select Reason</option>';
					for($c=0; $c<sizeof($this->reasons); $c++) { //Run through each report reason
						echo '<option value='.$this->reasons[$c][0].'>'.$this->reasons[$c][2].'</option>'; //Supplying readson and name to generate list dynamically
					}
				?>
				</select> 
				<textarea name="evidence" placeholder="Supply evidence/description on the report"></textarea>
				<textarea name="comments" placeholder="Any comments on this?"></textarea>
				<input type="hidden" name="content_id" value="<?php echo $this->answer['id']; ?>">
				<input type="submit" value="Send" class="button small">
			</form>
	</div>
</div>

