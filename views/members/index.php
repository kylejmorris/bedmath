<div id="Members">
	<div id="Container" class="clearfix">
		<form action="<?php echo ROOT.'search/users/';?>" method=POST>
			<input type="text" name="query" placeholder="Search user..." value="">
			<input type="submit" value="Submit">
		</form>
		Page: 
		<?php
			foreach($this->pagination as $value) {
				echo '<b><a href='.ROOT.'members/page/'.str_replace(',', '',$value).'>'.$value.'</a></b>';
			}
		?>

		<?php
		//Running loop on each user, allowing specific user info to be grabbed from $value
		foreach($this->userList as $key => $value) { 
			echo 'Username: '.'<a href='.ROOT.'profile/user/'.$value['user_id'].'>'.$value['username'].'</a>';
			echo $value['user_level'];
			echo 'Joined: '.date('m-d-Y',$value['join_date']).'';
			echo 'User #'.$value['user_id'].'';
			echo 'Points:'.$value['points'].'';
		}
		?>
	</div>
</div>