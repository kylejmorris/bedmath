<body class="dark">
	<div id="Account">
		<header>
			<div id="Container" class="clearfix">
				<ul class="right NoList">
					<a class="button grey header" href="<?php echo ROOT;?>">Cancel</a>
					<a class="button blue header" href="<?php echo ROOT;?>register">Sign-up</a>
				</ul>
			</div>
		</header>
		<div id="Content">
			<div id="Box" class="account center login">
				<form action="<?php echo ROOT;?>login/run" method="POST">
					<div id="Input">
						<span class="icon">&#128100;</span>
						<input  type="text" name="username" placeholder="Username">
					</div>
					<div id="Input">
						<span class="icon">&#128273;</span>
						<input type="password" name="password" placeholder="Password">
					</div>
					<div id="Input">
						<input type="submit" value="Login" class="login-button">
					</div>
					<a class="graylink" href="<?php echo ROOT;?>recover"> Need some help ? </a>
				</form>
			</div>
		</div>
	</div>
</body>
			   