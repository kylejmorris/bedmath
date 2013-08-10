<div class="row Questions">
	<div class="column-9">
		<?php
			foreach($this->questions as $question) {
			if($question['answer_count']==0) { //If question has no answers, highlight it as priority. 
				echo '<div id="Question">';
				$question['avatar']->render(); //Creating avatar image
				echo '<h3><a href='.ROOT.'review/question/'.$question['id'].'>'.$question['title'].'</a></h3>';
				echo '<div id="Bid">';
				echo $question['bid'];
				echo '</div>';
				echo '<p>';
				echo 'Topic: '.$question['topic'].'<br>';
				echo 'Posted by: '.$question['asked_by'].' on '.date('M d, Y', $question['asked_time']).'';
				echo '</p>';
				echo '<a class="button small blue" href='.ROOT.'giveanswer/question/'.$question['id'].'>Answer</a><br>';
				echo '<a class="report" href='.ROOT.'reporting/question/'.$question['id'].'>Report</a>';
				echo '</div>';
			} else {
				echo '<div id="Question">';
				$question['avatar']->render();
				echo '<h3><a href='.ROOT.'review/question/'.$question['id'].'>'.$question['title'].'</a></h3>';
				echo '<div id="Bid">';
				echo $question['bid'];
				echo '</div>';
				echo '<p>';
				echo 'Answers: '.$question['answer_count'].'<br>';
				echo 'Posted by: '.$question['asked_by'].' on '.date('M d, Y', $question['asked_time']).'';
				echo '</p>';
				echo '<a class="button small blue" href='.ROOT.'giveanswer/question/'.$question['id'].'>Answer</a>';
				echo '<a class="report" href='.ROOT.'reporting/question/'.$question['id'].'>Report</a>';
				echo '</div>';
			}
		}
		?>
	</div>
	<div class="column-4">
			<a class="button special small" href="<?php echo ROOT.'ask/';?>">Ask a Question</a>
			<div id="Filter">
				<select id="Bid" onChange=sortBids(this.value)>
					<option value=0>Minimal Bid</option>
					<option value=10>10+</option>
					<option value=25>25+</option>
					<option value=50>50+</option>
					<option value=100>100+</option>
					<option value=250>250+</option>
					<option value=500>500+</option>
					<option value=1000>1000+</option>
				</select>
				<select id="Topics" onChange=sortTopics(this.value)>
					<?php
						echo '<option value=0>'.'Select Topic'.'</option>';
						foreach($this->topics as $topic) {
							echo '<option value='.$topic['cat_id'].'>'.$topic['name'].'</option>';
						}
					?>
				</select>
		</div>
	</div>
	<script type="text/javascript">
		function sortTopics(topic) {
			location.href="<?php echo ROOT.'questions/view/1/';?>" + topic + "<?php echo '/'.$this->bid;?>";
		}
		function sortBids(minimal) {
			location.href="<?php echo ROOT.'questions/view/1/'.$this->topic.'/';?>" + minimal;
		}
	</script>
</div>
