<?php

?><form action="<?php echo ROOT.'account/runWritingEdit/'.$this->writing[0]['content_id'];?>" method="POST">
Title: <input type="text" name="title" value="<?php echo $this->writing[0]['title'];?>">
<br>
Description: <textarea name="description" rows="10" cols="80"><?php echo $this->writing[0]['description']; ?></textarea>

<br>
<input type="submit" value="Save Changes">
</form>