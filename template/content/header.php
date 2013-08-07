<body class="dark">
	<div id="Wrapper">
		<header>
			<?php
				$user = new User();
				if($user->isLoggedIn()) {
					echo '<div id="Holder">';
					echo '<nav class="left">';
					echo '<ul class="NoList">';
					echo '<li><a href="'.ROOT.'questions/"'.'>Questions</a></li>'; 
					echo '<li><a href="'.ROOT.'ask/"'.'>Ask</a></li>';
					echo '<li><a href="'.ROOT.'redeem/"'.'>Redeem</a></li>'; 
					echo '</ul>';
					echo '</nav>';
					echo '<div id="Logo" class="right">';
					echo '<a href="">Bedmath </a>';
					echo '</div>';
					echo '</div>';
					echo '<div id="Create">';
					echo '<a class="button header green" href="'.ROOT.'login/logout"'.'> Sign out</a>';
					echo '<a class="button header blue" href="'.ROOT.'account"'.'> My account</a>';
					echo '</div>';
					$userLevel = $user->getUserLevel($user->getUserId()); //Getting userlevel based on the logged in session id
					if($userLevel >= 3) { //Only include if user is marking staff group, or higher in power.
						$report = new Report();
						$reportCount = $report->getReportCount('pending');
						echo '<div id="Staff">';
						echo '<a href="'.ROOT.'mod/mod_users/" class="first left">Users</a>';
						echo '<a class="left" href="'.ROOT.'mod/mod_points">Points</a>';
                        echo '<a class="left" href="'.ROOT.'mod/mod_questions">Questions</a>';
                        echo '<a class="left" href="'.ROOT.'mod/mod_answers">Answers</a>';
						echo '<div class="right"id="Reports">';
						echo '<a href="'.ROOT.'mod/mod_report/reports/">';
						if ($reportCount > 1 ) {
							echo '<span class="number"> '.$reportCount.' </span>';
							echo '<span class="report"> Reports </span>';
						}
						elseif ($reportCount == 0) {
							echo '<span> No Reports </span>';
						}
						elseif ($reportCount == 1) {
							echo '<span class="number"> '.$reportCount.' </span>';
							echo '<span class="report"> Report </span>';
						}
						echo '</a>';
						echo '</div>';
						echo '</div>';
					}
				}
				else {
						echo '<div id="Holder">';
						echo '<nav class="left">';
						echo '<ul class="NoList">';
						echo '<li><a href="'.ROOT.'members/"'.'>Why ?</a></li>'; 
						echo '<li><a href="#">Features</a></li>';
						echo '<li><a href="#">About us</a></li>';
						echo '</ul>';
						echo '</nav>';
						echo '<div id="Logo" class="right">';
						echo '<a href="'.ROOT.'">Bedmath </a>';
						echo '</div>';
						echo '</div>';
						echo '<div id="Create">';
						echo '<a class="button header blue" href="'.ROOT.'register"'.'> Sign-up</a>';
						echo '<a class="button header green" href="'.ROOT.'login"'.'> Sign-in</a>';
						echo '</div>';
				}
			?>
		</header>