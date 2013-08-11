<?php

/**
 * Important object in the bedmath framework, used to notify users when relevant activity takes place
 */
Class Notification {
    private $database;
    public function __construct($db) {
        $this->database = $db;
    }
    
    /**
     * Gather notifications for user.
     * @param type $type the type of notification example: question, answer. 
     * @param type $subject the user who triggered the notification, example: {subject} Posted a new problem. 
     * @param type $object the user who is directly affected by the notification. Example: {subject} replies to {object} question.
     * @param type $viewed boolean true if notification has been seen by subject, false otherwise. 
     * @param type $page the page being loaded, if styled in this manner
     * @param type $limit max amount of notifications to list on a page.
     */
    public function getNotifications($type, $subject, $object, $contentId, $viewed, $page, $limit) {
        $notifications = $this->database->getByPage('g0g1_notifications', array('id', 'type', 'subject', 'object', 'time', 'viewed'), array('type'=>$type, 'subject'=>$subject, 'object'=>$object, 'time'=>array($time, '>'), 'viewed'=>$viewed), 'time', $page, $limit);
        return $notifications;
    }
    
    /**
     * Set current notifications as viewed in database so they don't show up in newest feed.
     * @param type $object the user receiving notification.
     */
    public function setAsViewed($object) {
        $this->database->update('g0g1_notifications', array('viewed'=>true), array('object'=>$object));
    }
    
    /**
     * Add a new notification to the system.
     * @param type $type
     * @param type $subject
     * @param type $object
     */
    public function addNotification($type, $subject, $object, $contentId) {
        $time = time();
        $this->database->insertRow('g0g1_notifications', array('type'=>$type, 'subject'=>$subject, 'object'=>$object, 'content_id'=>$contentId, 'time'=>$time, 'viewed'=>'0'));
    }
}
?>
