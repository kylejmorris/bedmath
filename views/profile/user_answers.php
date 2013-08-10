<div class="row profile">
	 <section id="Menu">
		<div class="column-11 Margin">
			<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/'; ?>">General</a>
			<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/questions'; ?>">Questions</a>
			<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/answers'; ?>">Answers</a>
			<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/reputation'; ?>">Reputation</a>
			<a href="<?php echo ROOT . 'profile/user/' . $this->userId . '/invites'; ?>">Invites</a>
		</div>
	</section>
	<div class="column-4">
		<h3>Answer Summary</h3>
			<?php
				echo 'User has posted <b>' . $this->answerSummary['total_posted'] . '</b> answers in which <b>' . $this->answerSummary['total_accepted'] . '</b> have been accepted and <b>' . $this->answerSummary['total_pending'] . '</b> are still pending. ' . '<br>';
				echo 'Most used topic: ' . $this->answerSummary['common_topic'] . '<br>';
				echo 'Most helped user: ' . $this->answerSummary['supported_student'] . '<br>';
			?>
	</div>
	<div class="column-7">
		<h3>Answer History</h3>
		<?php
		foreach ($this->answerHistory as $answer) {
			echo '<a href='.ROOT.'review/question/'.$answer['question_id'].'><b>'.$answer['question_name'].'</b></a><br>';
			echo '<b>time:</b>' . $answer['time'] . '<br>';
			if ($answer['accepted'] == 1) {
				echo '<b>State</b>: Accepted<br>';
			}
		}
		?>
		<div id="pagination">
			<?php
			foreach ($this->pagination as $page) {
				echo '<a href=' . ROOT . 'profile/user/' . $this->userId . '/answers/' . str_replace(',', '', $page) . '/>' . $page . '</a>';
			}
			?>
		</div>
	</div>
</div>
