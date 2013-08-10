<div id="Members">
	<section id="Title">
		<div class="row">
				 <div class="column-11">
					 <h3> Members </h3>
					 <div id="Search">
						<form action="<?php echo ROOT.'search/users/';?>" method=POST>
							<input type="text" name="query" placeholder="Username" value="" autocomplete="off" autofocus="autofocus">
							<input type="submit" value="Find">
						</form>
					</div>
				 </div>
		</div>
	</section>
		<?php
		//Running loop on each user, allowing specific user info to be grabbed from $value
		foreach($this->userList as $key => $value) { 
			echo '<section id="Member">';
			echo '<div class="column-11">';
			echo '<h3> '.'<a href='.ROOT.'profile/user/'.$value['user_id'].'>'.$value['username'].'</a></h3>';
			echo '<p id="Userrole">';
			echo $value['user_level'];
			echo '</p>';
			echo 'Joined: '.date('m-d-Y',$value['join_date']).'';
			echo '<p> Points:'.$value['points'].'</p>';
			echo '</div>';
			echo '</section>';
		}
		?>
		<div id="Pagination">
			 <div class="column-8 space-2">
				<span> Page </span>
					<?php
						foreach($this->pagination as $value) {
							echo '<div id="Item" class="column-11">';
							echo '<b><a href='.ROOT.'members/page/'.str_replace(',', '',$value).'>'.$value.'</a></b>';
							echo '</div>';
						}
					?>
			</div>
		</div>
</div>