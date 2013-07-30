<h4><a href="<?php echo ROOT.'account/invites/';?>">View your invite history:</a></h4>
<h3>Your personal invite link:</h3>
<p><?php echo ROOT.'register/r/'.$this->username.'<br>';?></p>
<?php
echo 'You have sent<b>'.$this->mailingCount.'/25.</b> emails today.';
?>
<form action="<?php echo ROOT.'newinvite/runinvite/';?>" method="POST">
	<textarea name="to" rows="5" cols=25 placeholder="Enter the addresses you wish to invite,separated by ',' commas"></textarea>
	<textarea readonly name="body" rows=10 cols=50><? echo $this->emailBody;?></textarea>
	<input type="submit" value="Invite">
</form>