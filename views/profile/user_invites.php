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
		<h3>Invite Summary</h3>
		<?php
			echo '<p> User has succesfully invited '.$this->inviteSummary['total_invites'].' new members!</p>';
		?>
	</div>
	<div class="column-7">
		<h3>Invite history</h3>
			<?php
			foreach($this->inviteHistory as $invite) {
				echo 'User: '.'<a href='.ROOT.'profile/user/'.$invite['user_id'].'>'.$invite['username'].'</a>'.' joined on '.date('M d Y', $invite['join_date']).'<br>';
			}
			?>

			<div id="pagination">
				<?php
				foreach ($this->pagination as $page) {
					echo '<a href=' . ROOT . 'profile/user/' . $this->userId . '/invites/' . str_replace(',', '', $page) . '/>' . $page . '</a>';
				}
				?>
			</div>
	</div>
</div>
