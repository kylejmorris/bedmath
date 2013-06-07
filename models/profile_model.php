<?php

class Profile_Model extends Model {

    public function __construct() {
        parent::__construct();
        $this->user = new User();
        $this->email = new Email();
        $this->image = new Image();
        $this->reputation = new Reputation();
        $this->question = new Question();
        $this->answer = new Answer();
        $this->category = new Category();
    }

    /*
     * Returns array of general details shown on all of users profile tabs.
     */

    public function getUserSummary($userId) {
        $userDetail = $this->user->getDetailFromId($userId);
        array_push($userDetail, 'avatar');
        array_push($userDetail, 'reputation');
        array_push($userDetail, 'questions_asked');
        array_push($userDetail, 'answers_posted');
        array_push($userDetail, 'top_topics');
        $userDetail['reputation'] = $this->reputation->getUserRep($userId);
        $avatarDetails = $this->image->getImageByContent(3, $userDetail['avatar_id']); //Getting avatar image details 
        $userDetail['avatar'] = $avatarDetails['image_name'] . '.' . $avatarDetails['file_type']; //Putting together image info to create url for avatar image. 
        $userDetail['questions_asked'] = $this->question->getQuestionCount(array('asked_by' => $userId));
        $userDetail['answers_posted'] = $this->answer->getAnswerCount(array('user' => $userId));
        $userDetail['top_topics'] = $this->reputation->getTopicsByRep($userId, 3);
        return $userDetail;
    }

    public function getQuestionHistory($userId, $topic, $page) {
        $where = array('asked_by' => $userId, 'topic' => $topic);
        $questions = $this->question->getQuestions($where, 'asked_time', $page, 10);
        for ($c = 0; $c < sizeof($questions); $c++) {
            if ($questions[$c]['solved_by'] != null) {
                $questions[$c]['solved_by'] = $this->user->getNameFromId($questions[$c]['solved_by']);
            }
        }
        return $questions;
    }

    public function getQuestionSummary($userId) {
        $summary = array('total_asked' => '', 'total_solved' => '', 'most_asked_topic' => '', 'most_helped_by' => '', 'highest_bid' => '');
        $summary['total_asked'] = $this->question->getQuestionCount(array('asked_by' => $userId));
        $questions = $this->question->getQuestions(array('asked_by' => $userId), 'asked_time', 1, $summary['total_asked']);
        $summary['total_solved'] = 0;
        $tutorCount = array(); //will contain a list where index is tutor id and value is number of questions they have answered for student.
        $summary['most_helped_by'] = null; //Tutor who has provided most accepted solutions to student.
        $summary['highest_bid'] = 0;
        foreach ($questions as $question) {
            if ($this->question->isSolved($question['id'])) {
                $summary['total_solved']+=1;
                $tutor = $this->answer->getAcceptedAnswer($question['id']);
                $tutorCount[$tutor['user']]++;
                if ($tutorCount[$tutor['user']] > $summary['most_helped_by']) { //If this tutor has answered more questions than highest amount recorded.
                    $summary['most_helped_by'] = $this->user->getNameFromId($tutor['user']);
                }
                if ($question['bid'] > $summary['highest_bid']) {
                    $summary['highest_bid'] = $question['bid'];
                }
            }
        }
        $topics = $this->category->getCategories();
        $highest = 0; //Holding the amount of questions in most_asked_topic.
        foreach ($topics as $topic) {
            $count = $this->question->getQuestionCount(array('asked_by' => $userId, 'topic' => $topic['id']));
            if ($count > $highest) {
                $highest = $count;
                $summary['most_asked_topic'] = $topic['name']; //The topic with most questions associated in it by user.
            }
        }
        foreach ($this->questions as $question) {
            $tutor = $this->answer->getAcceptedAnswer($question['id']);
        }
        return $summary;
    }

}

?>