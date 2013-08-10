<body class="login">
		<div class="outer">
			<div class="inner">
				<h1 id="Logo" class="center">
					<a href="<?php echo ROOT;?>"> Bedmath </a>
				</h1>
				<div id="login-form">
					 <h2 class="center"> Sign-up </h2>
					<form action="<?php echo ROOT;?>register/run" method="post">
							<input type="text" name="username" placeholder="Username">
							<input type="password" name="password" placeholder="Password">
							<input type="text" name="email" placeholder="Email">  
						<?php 
							if(isset($this->ref)) {
								echo "<input type='hidden' name='invited_by' value='$this->ref'>";
							}
						?>
						<div class="actions">
								<p class="smallsize gray pull-left">
								   <a href="<?php echo ROOT;?>recover"> Need some help ? </a>
								</p>
							<input type="submit" value="Register" class="button small">
						</div>
					</form>
				</div>
			</div>
		</div>
</body>
			   