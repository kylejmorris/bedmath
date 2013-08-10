<div class="row ask">
	 <div class="column-11">
			<?php
				echo '<b>You are reporting:</b> '.$this->details[1].'<br>';
				echo '<h3>Please fill out the form below, with a valid reason</h3>';
			?>
			<form action="<?php echo ROOT;?>reporting/runuser" method="POST">
				<select name="reason">
				<?php
					for($c=0; $c<sizeof($this->reasons); $c++) { //Run through each report reason
						echo '<option value='.$this->reasons[$c][0].'>'.$this->reasons[$c][2].'</option>'; //Supplying readson and name to generate list dynamically
					}
				?>
				</select> 
				<textarea name="evidence">Supply evidence/description on the report</textarea>
				<textarea name="comments">Any comments on this?</textarea>
				<input type="hidden" name="content_id" value="<?php echo $this->id; ?>">
				<input type="submit" value="Send" class="button small">
			</form>
	</div>
</div>

