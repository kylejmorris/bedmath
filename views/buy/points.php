<div id="Container" class="clearfix">
  <div id="Buy">
	  <h2>Buy Points</h2>
		<?php
			if(Session::exists('user_id')) {
				$points = new Points();
				echo 'Your current total points is '.$points->getPoints(Session::get('user_id')).'.';
			}
		?>
		<br>
		Select the number of points you want to buy. The cost is $1 for 800 points, no extra fees. Purchase up to a maximum of 800000 points.
		<p><b>Number of Points to Buy:</b></p>
		<select name="numpointstobuy" id="numpointstobuy" onchange="updateTotal()">
		<?php
			for ($points=800;$points<=800000;$points+=800) {
				echo '<option value="'.$points.'">'.$points.'</option>';
			}
		?>
		</select>
		Total cost: <font color="red"><label name="totalamount" id="totalamount">$1</label></font>
		<br>
		<br>
		<form action="https://www.<?php if (PAY_SANDBOX) echo "sandbox.";?>paypal.com/cgi-bin/webscr" method="post" name="frm_paypal">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="<?php echo PAY_ADDRESS;?>">
			<input type="hidden" id ="pointcount" name="item_name" value="800 GOG Points">
			<input type="hidden" id="payamount" name="amount" value="1">
			<input type="hidden" name="tax" value="0">
			<input type="hidden" name="no_shipping" value="0">
			<input type="hidden" name="return" value="<?php echo ROOT;?>buy/success">
			<input type="hidden" name="notify_url" value="<?php echo ROOT;?>ipn.php">
			<input type="hidden" name="cancel_return" value="<?php echo ROOT;?>buy/points">
			<input type="hidden" name="custom" value="<?php echo Session::get('user_id');?>">
			<input type="hidden" name="logo_custom" value="<?php echo ROOT;?>images/icons/btn_buynowCC_LG.gif">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="currency_code" value="<?php echo PAY_CURRENCY;?>">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="bn" value="PP-BuyNowBF">
			<input type="image" src="<?php echo ROOT.'images/icons/btn_buynowCC_LG.gif';?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1" alt="" border="0">
		</form>
	</div>
</div>
<script>
	function updateTotal() {
		var el=function(id) {
			return document.getElementById(id)
		}
		var points=el("numpointstobuy").value;
		var money=points/800;
		el("totalamount").innerHTML='$'+money
		el("payamount").value=money
		el("pointcount").value=points+" GOG Points"
	}
	updateTotal();
</script>
