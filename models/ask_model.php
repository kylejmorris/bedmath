<?php
class Ask_Model extends Model {
	public function __construct() {
		parent::__construct();
		$this->user = new User();
		$this->report = new Report(); 
		$this->question = new Question();
                $this->points = new Points();
	}
	
	public function runAsk($form) {
		array_push($form, 'asked_time');
		array_push($form, 'asked_by');
		$form['asked_by'] = $this->user->getUserId();
		$form['asked_time'] = time();
                $this->points->removePoints($form['asked_by'], $form['bid'], 12);
		$this->question->addQuestion($form);
                
        }
}

?>