<LINK href="<?php echo ROOT; ?>/template/css/template<?php echo $this->template;?>.css" rel="stylesheet" type="text/css">
<?php 
	$report = new Report();
	$reportCount = $report->getReportCount();
?>
<div class="staff_nav_bar">
        <a href="<?php echo ROOT.'validate/writing/'; ?>">Activate</a>
        <a href="<?php echo ROOT.'content_calculator'; ?>"/>Content Calculator</a>
        <a href="<?php echo ROOT.'mod/mod_users/'; ?>"/>Manage Users</a>
		<a href="<?php echo ROOT.'mod/mod_report/reports/'; ?>"/>Threat Reports</a>
        <a href="<?php echo ROOT.'mod/mod_points/'; ?>"/>Manage Points</a>
        <?php
		if($reportCount==0) {
			echo '<i>0 Reports</i>';
		} else {
			echo '<b>'.$reportCount.' Report(s)   </b>';
		}
		?>
		<br><br>
</div>