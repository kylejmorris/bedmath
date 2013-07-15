<body>
		<div id="Content">
			<div id="HeaderWrapper">
				<div id="HeaderBg">
					<div id="Header">
						<div id="HeaderTop">
							<div id="Container" class="clearfix">
								<div id="HeaderTopContent">
									<?php
									$user = new User();
									if($user->isLoggedIn()) {
										echo '<div id="Utiliy">';
										echo '<ul class="right">';
										echo '<li class="Blog"> <a href="http://blog.bedmath.com">Blog</a> </li>';
										echo '<li class="Support"> <a href="http://help.bedmath.com">Support</a></li>';
										echo '<li class="Sign-in"> <a href="'.ROOT.'/Login/Logout">Log out</a></li>';
										echo '</ul>';
										echo '</div>';
										echo '<div id="Logo" class="left">';
										echo '<a href="">Bedmath </a>';
										echo '</div>';
										echo '<div id="Navigation" class="right">';
										echo '<ul>';
										echo '<li><a href="'.ROOT.'questions/"'.'>Questions</a></li>'; 
										echo '<li><a href="'.ROOT.'ask/"'.'>Ask</a></li>';
										echo '<li><a href="'.ROOT.'redeem/"'.'>Redeem</a></li>'; 
										echo '</ul>';
										echo '</div>';
										$userLevel = $user->getUserLevel($user->getUserId()); //Getting userlevel based on the logged in session id
										if($userLevel >= 3) { //Only include if user is marking staff group, or higher in power.
										   $report = new Report();
										   $reportCount = $report->getReportCount();
										   echo '</div> </div> </div>';
										   echo '</div>';
										   echo '</div>';
										   echo '<div id="Staff">';
										   echo '<div id="Container" class="clearfix">';
										   echo '<a href="'.ROOT.'mod/mod_users/" class="first left">Users</a>';
										   echo '<a class="left" href="'.ROOT.'mod/mod_points">Points</a>';
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
										   echo '</div>';
										   echo '</div>';
										}
										elseif($userLevel < 3) {
										   echo '</div>';
										   echo '</div>';
										   echo '</div>';
										   echo '</div>';
										   echo '</div>';
										   echo '</div>';
										   echo '</div>';
										}
									}
									else {
										echo '<div id="Utiliy">';
										echo '<ul class="right NoList">';
										echo '<li class="Blog"> <a href="http://blog.bedmath.com">Blog</a> </li>';
										echo '<li class="Support"> <a href="http://help.bedmath.com">Support</a></li>';
										echo '<li class="Sign-in"> <a href="'.ROOT.'/Login">Sign-in</a></li>';
										echo '</ul>';
										echo '</div>';
										echo '<div id="Logo" class="left">';
										echo '<a href="'.ROOT.'">Bedmath </a>';
										echo '</div>';
										echo '<div id="Navigation" class="right">';
										echo '<ul class="NoList">';
										echo '<li><a href="'.ROOT.'members/"'.'>Why ?</a></li>'; 
										echo '<li><a href="#">Features</a></li>';
										echo '<li><a href="#">About us</a></li>';
										echo '</ul>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</div>';
									}
					?>