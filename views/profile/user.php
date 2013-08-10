<div class="row profile">
	 <div class="column-11 Margin">
		  <div id="Userinfo">
				<?php
					echo '<img src='.IMAGE_ROOT.$this->userDetail['avatar'].' width="75px" height="100px"><br>';
					echo '<h3>'.$this->userDetail['username'].'</h3>'.'<br>';
				?>
		  </div>
	 </div>	
	 <section id="Menu">
		<div class="column-11 Margin">
				<a href="<?php echo ROOT.'profile/user/'.$this->userId.'/';?>">General</a>
				<a href="<?php echo ROOT.'profile/user/'.$this->userId.'/questions';?>">Questions</a>
				<a href="<?php echo ROOT.'profile/user/'.$this->userId.'/answers';?>">Answers</a>
				<a href="<?php echo ROOT.'profile/user/'.$this->userId.'/reputation';?>">Reputation</a>
				<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/invites'; ?>">Invites</a>
		  </div>
	  </section>
	  <div class="column-4">
		   <h3> General </h3>
			<?php
				$joinDate = $this->userDetail['join_date']; //Need to convert date to be readable. 
				$joinDate = date('F d, Y', $this->userDetail['join_date']);
				echo 'Joined on: '.$joinDate.'<br>';
				echo 'Reputation: '.$this->userDetail['reputation'].'<br>';
				echo 'Questions asked: '.$this->userDetail['questions_asked'].'<br>';
				echo 'Answers posted: '.$this->userDetail['answers_posted'].'<br>';
			?>
	</div>
	<div class="column-4">
		<h3>Best topics</h3>
		<?php
		foreach($this->userDetail['top_topics'] as $topic) {
			echo $topic[0].' with ';
			echo $topic[1].' reputation'.'<br>';
		}
		?>
	</div>
</div>
