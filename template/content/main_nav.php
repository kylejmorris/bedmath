		<div id="Navigation">
			<ul>
			<?php
                        $user = new User();
				if($user->isLoggedIn()) { 
					echo '<li><a href="'.ROOT.'questions/"'.'>Questions</a></li>';
					echo '<li><a href="'.ROOT.'ask/"'.'>Ask</a></li>';
					echo '<li><a href="'.ROOT.'buy/points/"'.'>Buy</a></li>';  
					echo '<li><a href="'.ROOT.'redeem/"'.'>Redeem</a></li>'; 
				}
				else {
					echo '<li><a href="'.ROOT.'members/"'.'>Explore</a></li>'; 
					echo '<li><a href="#">Features</a></li>';
					echo '<li><a href="#">Blog</a></li>';
				}
			?>
			</ul>
		</div>
		<div id="Sign-up">
		<?php 
			if($user->isLoggedIn()) {
				echo '<a href='.ROOT.'login/logout class="button normal">Logout</a>';
				echo '<a href='.ROOT.'account/ class="button normal">Account</a>';
					} else {
				echo '<a class="button normal" href='.ROOT.'login/ >Sign-in</a>';
				echo '<a class="button green" href='.ROOT.'register/ > Sign-up </a>';
					}
		?>
		</div>
	</div> <!-- Ends Container -->
</div> <!-- Ends header object -->
</div>

<?php
//Code below will determine if navigation bar for staff will be loaded.
if($user->isLoggedIn()) { 
    $userLevel = $user->getUserLevel(Session::get('user_id')); //Getting userlevel based on the logged in session id
    if($userLevel >= 3) { //Only include if user is marking staff group, or higher in power.
        include 'staff_nav.php';
    }
}
?>

