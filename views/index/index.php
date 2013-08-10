<body>
	<div id="Wrapper">
		<section id="Welcome">
			<div id="Overlay">
				 <div class="row">
					<div id="Userbar">
						 <div id="Login">
							  <a href="<?php echo ROOT;?>login" class="button small special"> Sign-in </a>
						 </div>
					</div>
					<div class="column-8" style="margin-left: 20%;">
						<h1 id="Logo">Bedmath</h1>
						<h2> The online math tutoring platform. </h2>
					</div>
				 </div>
			</div>
		</section>
		<section id="Why">
				 <div class="row">
					  <div class="column-3 space-1">
						   <h3> What is bedmath ? </h3>
						   <p> Get help from many tutors at once, or earn some cash by tutoring! You don't even have to get up, it's right here on Bedmath. </p>
					  </div>
				</div>
		</section>
		<section id="Features">
				<div class="row">
					  <div class="column-11 space-1">
						   <h3> Features </h3>
						   <div class="column-6">
								<h5> Ask Questions </h5>
								<p> Post your Questions in real-time. No more teachers needed, bedmath solves your problem with them </p>
						   </div>
						   <div class="column-6">
								<h5> Teach others </h5>
								<p> Answer Questions from the community, receive your points and redeem them for real cash ! </p>
						   </div>
					  </div>
				</div>
		</section>
		<section id="Stats">
					<div class="row">
						<div class="column-3 space-1">
							<h3> Statitics </h3>
							<p> 
								<?php 
									  echo $this->userCount.' members ';
									  echo '<br>';
									  echo $this->answerCount.' questions solved.';
								?>
							</p>
						</div>
					</div>
		</section>
		<section id="Join">
					<div class="row">
						<div class="column-11 space-1">
							 <p>  Bedmath is currently in closed beta, but ofcourse you can sign-up to be ready for our public launch ! </p>
						</div>
						<div class="column-6 space-3 Margin">
							<a href="/register" class="button special"> Join us Today</a>
						</div>
					</div>
		</section>
	</div>
</body>