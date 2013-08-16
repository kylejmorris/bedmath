<form action="<?php echo ROOT.'redeem/run';?>" method='POST'>
<select name="redeem_amount" id="redeem_amount" onchange="updateTotal()">
	<?php
		for($points=1000;$points<=100000;$points+=1000) {
			echo '<option value="'.$points.'">'.$points.' points</option>';
		}
	?>
</select>
    <br><br>
    <font color="green">Meeting redeem requirements.</font>
    <br>
    <font color="orange">Still qualify, but lots of yellow will require thorough examination of your account to ensure validity.</font>
    <br>
    <font color="red">Not meeting redeem requirements. Please fix red areas before sending a request.</font>
    <br><br><br>
    <?php
    foreach($this->checks as $check) {
        echo $check.'<br>';
    }
    ?>




<input type="submit" class="button big"value="Request Cashout">
</form>
<script>
	function updateTotal() {
		var el=function(id) {
			return document.getElementById(id)
		}
		var points=el("redeem_amount").value;
		var money=points/1000;
		el("totalamount").innerHTML='$'+money
		el("payamount").value=money
		el("pointcount").value=points+" GOG Points"
	}
	updateTotal();
</script>