<body class="login">
	<div class="outer">
		 <div class="inner">
			 <h1 id="Logo" class="center">
				<a href="<?php echo ROOT;?>"> Bedmath </a>
			 </h1>
			 <div id="login-form">
						  <h2 class="center"> Sign-in </h2>
						  <form action="<?php echo ROOT;?>login/run" method="POST">
									<input type="text" name="username" placeholder="Username" autocomplete="off">
									<input type="password" name="password" placeholder="Password" autocomplete="off">
									<input type="hidden" name="returnPage" value="<?php echo $this->returnPage;?>"></input>	
									<div class="actions">
										<p class="smallsize gray pull-left">
										   <a href="<?php echo ROOT;?>recover"> Need some help ? </a>
										</p>
										<input type="submit" value="Login" class="button small">
									</div>
						  </form>
			 </div>
		 </div>
	</div>
</body>
