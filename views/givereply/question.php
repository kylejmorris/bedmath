<div id="Form">
<form action="<?php echo ROOT.'givereply/questionRun/'.$this->qid.'/'.$this->answerId;?>" method="POST">
<textarea name="full_text" rows=15 cols=35 value="" placeholder="Enter reply. . . ."></textarea>
<input type="submit" class=button value="Post reply"></input>
</form>
</div>