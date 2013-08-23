<?php

/**
 * @author Kyle Morris
 * Manages emails. Communicates with database to store/retrieve emails.
 */
class Email {

    /**
     * The main user object. Associated with user receiving mail
     * @var User
     */
    public $user;

    /**
     * Defined as database object associated with emails
     * @var Database
     */
    public $database;

    /**
     * The user receiving email
     * @var int
     */
    public $receiver;

    /**
     * Email address of receiver
     * @var string
     */
    public $address;

    /**
     * Certain default emails (found in g0g1_mail) are associated with an ID. These email templates can be called using this variable when containing a valid ID
     * @var int
     */
    public $mailId;

    /**
     * The email subject/title
     * @var string
     */
    public $subject; // Title of email

    /**
     * Contains body of email
     * @var string
     */
    public $message; //Mail contents

    /**
     * Header information sent over mail
     * @var string
     */
    public $headers; //Header info sending over mail

    /**
     * An array containing search terms for default mail templates. 
     * These are terms in which will be replaced with valid information when mail is being sent.
     * Array elements:
     * 		[USERNAME]: filler to contain username of receiver
     * 		[CURRENT_POINTS]: will contain current points of user on the site
     * @var array[string]
     */
    public $search = array("[ROOT]", "[USERNAME]", "[USER_ID]", "[CURRENT_POINTS]", "[EMAIL_RECOVERY_CODE]");

    /**
     * Will contain values to replace for contents of $search. 
     * Example: the username to replace [USERNAME] in $search array
     * Note: Make sure the elements in replacement have the same index value as those in $search,  
     * such as $search[0] and $replacement[0] both being username. 
     * @var array[]
     */
    public $replacement = array();

    /**
     * Initializes database and user object
     */
    function __construct($db) {
        if($db==null) {
            $this->database = new Database();
        } else {
            $this->database = $db;
        }
        $this->user = new User($this->database);
    }

    public function generateCustomMail() {
        
    }

    /**
     * Initializes database and user object
     * Retrieves email template that is returned from database
     * @param $id The id number of default email to retrieve 
     */
    public function getDefaultContent($id) {
        $query = "SELECT content, subject FROM g0g1_mail WHERE mail_id = '$id'";
        $row = $this->database->query($query);
        $result = $row->fetch();
        return $result;
    }

    public function isValidEmail($email) {
        $regex = "^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)";
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Used to create replacement array for later use to replace content in email. 
     * Example: gets information such as username, to replace with [USERNAME] from $search array. 
     * @param userId The id of user in which will have information fed into email template
     */
    public function getReplacement($userId) {
        $details = $this->user->getDetailFromId($userId);
        $replace = array(ROOT, $details['username'], $details['user_id'], $details['points'], $details['activate_code']); //What is being replaced in email. Such as [USERNAME]
        return $replace;
    }

    /**
     * Gets email from database that is associated with the mail id, 
     * files placeholders with user details obtained from the users id.
     * @param $mailId Id of default mail to send, this will be associated with default mail in database
     * @param $userId User id of whom will have information populating email template.
     * Example: if user id for account (Kyle) was selected, then [USERNAME] in email is replaced with Kyle
     */
    function generateDefaultMail($mailId, $userId) {
        $content = $this->getDefaultContent($mailId); //Get specified default email template
        $this->mailId = $mailId;
        $this->replacement = $this->getReplacement($userId);
        $this->message = str_replace($this->search, $this->replacement, $content['content']); //Replacing filler spaces in email template.
        $this->receiver = $this->user->getEmailFromId($userId); //Default email for now.
        $this->subject = $content['subject']; //Email subject getting from database/
    }

    /**
     * Runs a series of checks to ensure the user is not spamming emails. 
     * @param type $userId the id of user to flood check.
     */
    private function floodCheck($senderId) {
        echo $this->receiver;
        $receiverId = $this->user->emailToId($this->receiver);
        if ($this->mailId == MAIL_SEND_INVITE) {
            if ($this->mailSentCount(MAIL_SEND_INVITE, $senderId, 86400) >= FLOOD_MAIL_INVITE) {
                return false;
            }
        }
        if ($senderId == null) {
            $senderId == 1;
            
            if ($this->mailId == MAIL_SEND_ACTIVATE) {
                if ($this->mailReceiveCount(MAIL_SEND_ACTIVATE, $this->receiver, 86400) >= FLOOD_MAIL_ACTIVATE) { //Has not sent over max emails per day
                    return false;
                }
            }
            if ($this->mailId == MAIL_SEND_RECOVERY) {
                if ($this->mailReceiveCount(MAIL_SEND_RECOVERY, $this->receiver, 86400) >= FLOOD_MAIL_RECOVERY) {
                    echo 'hi';
                    return false;
                }
                echo $this->mailReceiveCount(MAIL_SEND_RECOVERY, $this->receiver, 86400);
            }
        } else {
            if ($this->mailId == MAIL_SEND_ACTIVATE) {
                if ($this->mailSentCount(MAIL_SEND_ACTIVATE, $senderId, 86400) >= FLOOD_MAIL_ACTIVATE) { //Has not sent over max emails per day
                    return false;
                }
            }
            if ($this->mailId == MAIL_SEND_RECOVERY) {
                if ($this->mailSentCount(MAIL_SEND_RECOVERY, $senderId, 86400) >= FLOOD_MAIL_RECOVERY) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Sends emails upon data being correctly formed. 
     * @param $addresses list of addressess to receive message.
     */
    public function sendMail($addresses) {
        $receivers = explode(',', $addresses);
        unset($receivers[sizeof($receivers) - 1]); //Last element is empty
        $senderId = $this->user->getUserId();
        if ($this->floodCheck($senderId)) { //Passes all flood checks.
            if($senderId==null) {
                $senderId=1;
            }
            if ($this->mailId == MAIL_SEND_INVITE) { //If sending invites, we must split the emails up.
                foreach ($receivers as $key => $value) {
                    if ($this->mailAlreadySent($senderId, trim($value))) {
                        unset($receivers[$key]);
                    }
                }
            }
            mail($addresses, $this->subject, $this->message, 'From: team@bedmath.com');
            if (sizeof($recievers) > 0) {
                foreach ($receivers as $receiverEmail) {
                    $this->logMail($senderId, trim($receiverEmail));
                }
            } else {
                $this->logMail($senderId, $addresses);
            }
        }
    }

    /**
     * Record email in database for moderation.
     * @param type $sId id of sender
     * @param type $receiver email address of receiver
     */
    public function logMail($sId, $receiver) {
        $time = time();
        $this->database->insertRow('g0g1_mail_log', array('default_id' => $this->mailId, 'sender' => $sId, 'time' => $time, 'receiver_email' => $receiver));
    }

    /**
     * Determine if an email was already sent, to reduce spam invites or other features.
     * @param type $sender id of user sending
     * @param type $receiver email address of receiver
     * @return boolean true if sent, false if not.
     */
    public function mailAlreadySent($sender, $receiver) {
        $count = $this->database->getCount('g0g1_mail_log', array('sender' => $sender, 'receiver_email' => $receiver));
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check how many mails have been send from a user over a certain amount of time. Used to prevent spam. 
     * @param type $type the type of mail sent
     * @param type $sender user id of sender
     * @param type $since timestamp of how far back to get emails from. 86400 would mean 86400 seconds ago, at earliest.
     */
    public function mailSentCount($type, $sender, $since) {
        $since = time() - $since;
        $count = $this->database->getCount('g0g1_mail_log', array('default_id' => $type, 'sender' => $sender, 'time' => array($since, '>')));
        return $count;
    }
    
    /**
     * Check how many mails have been received by a user. 
     * This is if a user is recovering there account for example, and keeps spamming emails to themselves. We need a way of recording who it is since they aren't logged in on their account.
     * @param type $type
     * @param type $receiver
     * @param type $since
     */
    public function mailReceiveCount($type, $receiver, $since) {
        $since = time()-$since;
        $count =  $this->database->getCount('g0g1_mail_log', array('receiver_email'=>$receiver, 'default_id'=>$type, 'time'=>array($since,'>')));
        return $count;
    }

}

?>