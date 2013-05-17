<?php

class Review_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->question = new Question();
        $this->answer = new Answer();
        $this->reputation = new Reputation();
    }

    public function question($id) {
        $questionData = $this->question->getDetailById($id);
        $questionData['asked_by'] = $this->user->getNameFromId($questionData['asked_by']);
        return $questionData;
    }

    public function getAnswers($id) {
        $answers = $this->answer->getAnswersByQuestion($id);
        for ($c = 0; $c < sizeof($answers); $c++) {
            array_push($answers[$c], 'avatar');
            array_push($answers[$c], 'reputation');
            array_push($answer[$c], 'user_id');
            $userDetail = $this->user->getDetailFromId($answers[$c]['user']);
            $question = $this->question->getDetailById($answers[$c]['question_id']); //Needed to retrieve questions associated math topic.
            $answers[$c]['user_id'] = $answers[$c]['user'];
            $answers[$c]['reputation'] = $this->reputation->getUserRep($answers[$c]['user'], $question['topic']);
            $answers[$c]['user'] = $this->user->getNameFromId($answers[$c]['user']);
            $image = new Image();
            $image->getImageByContent(3, $userDetail['avatar_id']); //Getting profile image of user
            $answers[$c]['avatar'] = $image;
        }
        return $answers;
    }

}

?>