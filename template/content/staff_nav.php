<LINK href="<?php echo ROOT; ?>/template/css/template<?php echo $this->template;?>.css" rel="stylesheet" type="text/css">
<?php 
	$report = new Report();
	$reportCount = $report->getReportCount();
?>
<div class="staff_nav_bar">
        Staff Panel: <a href="<?php echo ROOT.'mod/mod_users/'; ?>"/>Users</a>|
		<a href="<?php echo ROOT.'mod/mod_report/reports/'; ?>"/>Threat Reports</a>|
        <a href="<?php echo ROOT.'mod/mod_points/'; ?>"/>Points</a>|
        <a href="<?php echo ROOT.'mod/mod_questions/'; ?>"/>Questions</a>
        <?php
		if($reportCount==0) {
			echo '<i>0 Reports</i>';
		} else {
			echo '<b>'.$reportCount.' Report(s)   </b>';
		}
		?>
		<br><br>
</div>