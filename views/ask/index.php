<h2>Bid Buddy</h2>
Helping you get the best support for the best price!

<div id="Container" class="clearfix">
	<div id="AccountPortal">
		<div id="Register">
			<form action="<?php echo ROOT.'ask/runAsk';?>" method="POST">
			<input type="text" name="title" value="" placeholder="Enter Title..."></input>
			<select name="topic">
			<option value="">Select Topic</option>
			<?php foreach($this->topics as $topic) {
				echo '<option value='.$topic['cat_id'].'>'.$topic['name'].'</option>';
			}
			?>
			</select>
			<textarea type="text" name="full" value="" placeholder="Put all the scary math here..."></textarea>
			<h2> Bidding details </h2>
			<input type="text" name="bid" value="" placeholder="Enter bid amount"></input>
			<input type="submit" value="Post Question"></input>
			</form>
		</div>
		<div id="Other">
		</div>
	</div>
	<script> CKEDITOR.replace( 'full' ); </script>
</div>
