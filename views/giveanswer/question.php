<div class="row reply">
	 <div class="column-11">
		  <div class="cover">
			  <?php
				echo '<h3>Reply to '.$this->question['title'].'</h3>';
				echo '<p>'.$this->question['full'].'<p>';
				echo 'Bid: '.$this->question['bid'].'<br>';
				echo 'Asked by: '.$this->question['asked_by'].' on '.date('D m Y', $this->question['asked_time']).'<br>';
			  ?>
		   </div>
	 </div>
	 <div class="column-11">
			<h3> Your Answer </h3>
			<form action="<?php echo ROOT.'giveanswer/questionrun/'.$this->qid;?>" method="POST">
				<textarea name="answer"></textarea>
				<p>
					<input type="submit" class="button small" value="Give Answer">
				</p>
			</form>
	</div>
	<script> CKEDITOR.replace( 'answer' ); </script>
</div>