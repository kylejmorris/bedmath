<div class="row sendinvite">
	 <div class="column-11">
		<h4>Your personal invite link</h4>
		<input type="text" value="<?php echo ROOT.'register/r/'.$this->username.'';?>">
		<?php
		echo '<p> You have sent <b>'.$this->mailingCount.' of 25 </b> emails today. </p>';
		?>
		<form action="<?php echo ROOT.'newinvite/runinvite/';?>" method="POST">
			<textarea name="to" rows="5" cols=25 placeholder="Enter the addresses you wish to invite,separated by ',' commas"></textarea>
			<textarea readonly name="body" rows=10 cols=50><?php echo $this->emailBody;?></textarea>
			<input class="button small" type="submit" value="Invite">
			<span class="or"> or </span>
			<a href="<?php echo ROOT.'account/invites/';?>">View your invite history</a>
		</form>
	</div>
</div>

		