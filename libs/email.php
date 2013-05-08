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
    *		[CURRENT_POINTS]: will contain current points of user on the site
    * @var array[string]
    */
    public $search = array("[USERNAME]", "[USER_ID]", "[CURRENT_POINTS]", "[EMAIL_RECOVERY_CODE]");
    
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
    function __construct() {
        $this->database = new Database();
        $this->user = new User();
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
		if(preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/',$email)) { 
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
        echo $details['username'];
        $replace = array($details['username'], $details['user_id'], $details['points'], $details['activate_code']); //What is being replaced in email. Such as [USERNAME]
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
        $this->replacement = $this->getReplacement($userId);
        $this->message = str_replace($this->search, $this->replacement, $content['content']); //Replacing filler spaces in email template.
        $this->receiver = $this->user->getEmailFromId($userId); //Default email for now.
        $this->subject = $content['subject']; //Email subject getting from database/
    }
    
    /**
    * Sends emails upon data being correctly formed. 
    * @param $addresses list of addressess to receive message.
    */
    public function sendMail($addresses) {
	mail($addresses, $this->subject, $this->message);
    }
}
?>