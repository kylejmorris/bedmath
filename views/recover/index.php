<body class="login recover">
		<div class="outer">
			 <div class="inner">
				<h1 id="Logo" class="center">
					<a href="<?php echo ROOT;?>"> Bedmath </a>
				</h1>
				<div id="login-form">
					<form action="<?php echo ROOT;?>recover/runrecovery" method="POST">
							<input type="text" name="username" placeholder="Username" autocomplete="off" autofocus="autofocus">
							<p class="information"> Your password will be sent to the email that you supplied at registration. If this email can't be reached anymore, please create a support ticket. </P>
							<div class="actions">
								<p class="smallsize gray pull-left">
								   <a href="<?php echo ROOT;?>"> Cancel </a>
								</p>
								<input type="submit" value="Recover" class="button small">
							</div>
					</form>
				</div>
			</div>
		</div>
</body>
			   