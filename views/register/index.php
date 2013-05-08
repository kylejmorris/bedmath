<div id="Container" class="clearfix">
<form action="<?php echo ROOT;?>register/run" method="post">
	<div id="AccountPortal">
		<div id="Register">
			<input type="text" name="username" placeholder="Pick a Username">
			<input type="password" name="password" placeholder="A strong password">
			<input type="text" name="email" placeholder="Your email">    
			<?php 
				if(isset($this->ref)) {
					echo "<input type='hidden' name='invited_by' value='$this->ref'>";
				} else {
					echo "<input type='text' name='invited_by' placeholder='Did someone invite you ?'>";
				}
			?>
        <input type="submit" value="Register" class="green">
		</div>
		<div id="Other">
			<h2> Our policy about your data </h2>
			<p> We will never sell, trade, share your information with other party's. </p>
			<p> We only use your email for passwords reset and other account actions. </p>
		</div>
	</div>
</form>
</div>