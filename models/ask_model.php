<?php
class Ask_Model extends Model {
        private $inflation = 0.03; //3% increase in what ever the average bid currently is, will be suggested to user.
	public function __construct() {
		parent::__construct();
	}
	
	public function runAsk($form) {
		array_push($form, 'asked_time');
		array_push($form, 'asked_by');
		$form['asked_by'] = $this->user->getUserId();
		$form['asked_time'] = time();
                $this->points->removePoints($form['asked_by'], $form['bid'], 12);
		$this->question->addQuestion($form);       
        }
        
        /**
         * Calculates average bid by getting sum of all bids on answered questions, and increasing the average by 3%.
         * Example: If 100 answered questions for Calculus averaged 850 points per question, the final result would be 876.
         */
        public function bidBuddy() {
            $topics = $this->category->getCategories();
            $averageBid = array();
            foreach($topics as $topic) {
                $qCount = $this->question->getSolvedCount(null, $topic['cat_id']); //Used to find average bid of all solved questions in topic.
                $questions = $this->question->getSolved(null, $topic['cat_id']);
                $total = 0; //The total sum of all answered questions.
                foreach($questions as $question) {
                    $total+=$question['bid'];
                }
                if($total==0) {
                    $averageBid[$topic['name']] = 50;
                } else {
                    $averageBid[$topic['name']] = ceil($total/$qCount+$total/$qCount*$this->inflation);
                }
            }
            return $averageBid;
        }
}

?>