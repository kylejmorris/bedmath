<div class="row sendinvite">
	 <div class="column-7 space-1">
		  <div id="AvatarPicker">
				<?php foreach($this->avatars as $value) {
					$avatar = '<img src='.IMAGE_ROOT.$value['image_name'].'.'.$value['file_type'].' id='.$value['content_id'].' width=50 height=50 onClick=selectImage('.$value['content_id'].')'.'>'.'<br>'; 
					echo $avatar;
					}
				?>
		  </div>
	 </div>
	 <div class="column-7 space-1">
		  <form name='details' action="runprofile" method="POST">
				Email : <input type="text" name="email" value="<?php echo $this->details['email'];?>"><br>
				<input type="hidden" name='avatar' value="">
				<input type="submit" class="button small" value="Submit">
		  </form>
	</div>
</div>
<script type='text/javascript'>
function selectImage(id) {
	document.details.avatar.value=id;
	alert('New image selected');
}
</script>
<style>
	img{
		float: left;
		margin-left: 5%;
	}
</style>

