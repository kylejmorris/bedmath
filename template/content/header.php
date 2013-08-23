<body>
	<div id="Wrapper">
		<header>
			<div class="row">
				<div class="column-11">
				<?php
					$user = new User();
					if($user->isLoggedIn()) {
						echo '<div id="Logo">';
						echo '<a href="">Bedmath </a>';
						echo '</div>';
						echo '<nav>';
						echo '<ul>';
						echo '<li><a href="'.ROOT.'questions/"'.'>Questions</a></li>'; 
						echo '<li><a href="'.ROOT.'ask/"'.'>Ask</a></li>';
						echo '<li><a href="'.ROOT.'redeem/"'.'>Redeem</a></li>'; 
						echo '</ul>';
						echo '</nav>';
						echo '<div id="Utility">';
						echo '<a class="button small blue" href="'.ROOT.'account"'.'> My account</a>';
						echo '<a class="button small" href="'.ROOT.'login/logout"'.'> Sign out</a>';
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
                                                        echo '<a class="left" href="'.ROOT.'mod/mod_redeem">Redeem</a>';
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
							echo '<div id="Logo">';
							echo '<a href="'.ROOT.'">Bedmath </a>';
							echo '</div>';
							echo '<nav>';
							echo '<ul>';
							echo '<li><a href="'.ROOT.'members/"'.'>Why ?</a></li>'; 
							echo '<li><a href="#">Features</a></li>';
							echo '<li><a href="#">About us</a></li>';
							echo '</ul>';
							echo '</nav>';
							echo '<div id="Utility">';
							echo '<a class="button small" href="'.ROOT.'login"'.'> Sign-in</a>';
							echo '</div>';
					}
				?>
				</div>
			</div>
		</header>