<body class="dark">
	<div id="Account">
		<header>
			<div id="Container" class="clearfix">
				<ul class="right NoList">
					<a class="button grey header" href="<?php echo ROOT;?>">Cancel</a>
				</ul>
			</div>
		</header>
		<div id="Content">
			<div id="Box" class="account center login">
				<form action="<?php echo ROOT;?>recover/runrecovery" method="POST">
					<div id="Input">
						<span class="icon">&#128100;</span>
						<input type="text" name="username" placeholder="Username">
					</div>
					<div id="Input">
						<input type="submit" value="Recover" class="login-button">
					</div>
					<p> Your password will be send to you by the email that you supplied in our database. If this email can't be reached anymore, please create a support ticket </P>
				</form>
			</div>
		</div>
	</div>
</body>
			   