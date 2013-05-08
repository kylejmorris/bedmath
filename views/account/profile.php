<div id='avatar'>
	<?php foreach($this->avatars as $value) {
		$avatar = '<img src='.IMAGE_ROOT.$value['image_name'].'.'.$value['file_type'].' id='.$value['content_id'].' width=50 height=50 onClick=selectImage('.$value['content_id'].')'.'>'.'<br>'; 
		echo $avatar;
	}
	?>
</div>
<form name='details' action="runprofile" method="POST">
Email: <input type="text" name="email" value="<?php echo $this->details['email'];?>"><br>
<input type="hidden" name='avatar' value="">
<input type="submit" value="Submit">
</form>
<script type='text/javascript'>
function selectImage(id) {
	document.details.avatar.value=id;
	alert('New image selected');
}
</script>