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
	<div class="column-5">
		<h3>Question Summary</h3>
			<?php
			echo 'User has posted: <b>' . $this->questionSummary['total_asked'] . '</b> questions in which <b>' . $this->questionSummary['total_solved'] . '</b> were solved.' . '<br>';
			echo 'Most questioned topic: <b>' . $this->questionSummary['most_asked_topic'] . '</b><br>';
			echo 'Most helped by: <b>' . $this->questionSummary['most_helped_by'] . '</b><br>';
			echo 'Highest bid: <b>' . $this->questionSummary['highest_bid'] . '</b> points <br>';
			?>
	</div>
	<div class="column-7">
		<h3>Question History</h3>
			<?php
			if (sizeof($this->questionHistory)>0) {
				foreach ($this->questionHistory as $question) {
					echo 'ID: ' . $question['id'] . ' | ';
					echo 'Topic: ' . $question['topic'] . ' | ';
					echo 'Asked: ' . date('M d Y', $question['asked_time']) . '<br>';
					echo '<a href=' . ROOT . 'review/question/' . $question['id'] . '/>' . $question['title'] . '</a><br>';
					echo 'Status: ';
					if ($question['solved_by'] != null) {
						echo 'Solved by: ' . $question['solved_by'];
					} else {
						echo 'Unsolved';
					}
					echo '<br>';
					echo 'Answered ' . $question['answer_count'] . ' time(s)';
					echo '<br><br>';
				}
			} else {
				echo 'No available questions';
			}
			?>
			<div id="pagination">
				<?php
				foreach ($this->pagination as $page) {
					echo '<a href=' . ROOT . 'profile/user/' . $this->userId . '/questions/' . str_replace(',', '', $page) . '/' . $this->topic . '>' . $page . '</a>';
				}
				?>
			</div>
		</div>
</div>
