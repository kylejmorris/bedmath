<body class="dark">
	<div id="Account">
		<header>
			<div id="Container" class="clearfix">
				<ul class="right NoList">
					<a class="button grey header" href="<?php echo ROOT;?>">Cancel</a>
					<a class="button blue header" href="<?php echo ROOT;?>login">Sign-in</a>
				</ul>
			</div>
		</header>
		<div id="Content">
			<div id="Box" class="account center login">
				<form action="<?php echo ROOT;?>register/run" method="post">
					<div id="Input">
						<span class="icon">&#128100;</span>
						<input type="text" name="username" placeholder="Username">
					</div>
					<div id="Input">
						<span class="icon">&#128273;</span>
						<input type="password" name="password" placeholder="Password">
					</div>
					<div id="Input">
						<span class="icon">&#9993;</span>
						<input type="text" name="email" placeholder="Email">  
					</div>
					<?php 
						if(isset($this->ref)) {
							echo "<input type='hidden' name='invited_by' value='$this->ref'>";
						} else {
							echo "<div id='Input'>";
							echo "<span class='icon '>&#128101;</span>";
							echo "<input type='text' name='invited_by' placeholder='Did someone invite you ?'>";
							echo "</div>";
						}
					?>
					<div id="Input">
						<input type="submit" value="Register" class="login-button">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
			   