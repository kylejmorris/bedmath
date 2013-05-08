<?php
class Writing {
	private $title;
	private $fullText;
	private $hits;
	private $unlocks;
	private $date;
   /**
   * Creates database object to link to from this class
   */
   function __construct() {
       $this->database = new Database();
       $this->user = new User();
       $this->image = new Image(); 
   }

	public function getPendingCount($state) {
		$where = array('activated'=>$state);
		return $this->database->getCount('g0g1_writing', $where);
	}
   /**
   * Processes writing contnet and submits to database. 
   * @param $data array containing elements named after g0g1_writing table. 
   */
   public function addWriting($data) {
        $userId = $this->user->getUserId();
        $time = time(); 
        $query = "INSERT INTO g0g1_writing (publisher_id, created, title, description, full_text, earn_type, lock_price) VALUES ('$userId', '$time', :title, :description, :full_text, :reward_type, :lock)"; 
        $stmt = $this->database->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':full_text', $data['full_text']);
        $stmt->bindParam(':reward_type', $data['reward_type']);
        $stmt->bindParam(':lock', $data['lock']);
        $stmt->execute();
        $contentId = $this->database->lastInsertId('content_id');
        $this->image->prepare($data['thumbnail'], 2); //Supplying form data, and type (2) being writing-thumbnail
        $this->image->uploadToContent($userId, $contentId);
   }
   
   /**
   * Updates writing content by setting new values and resubmitting to database.
   * @param $data array containing elements representing table columns in g0g1_writing table.
   * @param $contentId the id of content to update.
   */
   public function updateWriting($data, $contentId) {
	$query = "UPDATE g0g1_writing SET ";
	if(isset($data['publisher_id'])) {
		$query .= "publisher_id=:publisher_id ";
	}
	if(isset($data['title'])) {
		$query .= "title=:title, ";
	}
	if(isset($data['description'])) {
		$query .= "description=:description, ";
	}
	if(isset($data['full_text'])) {
		$query .= "full_text=:full_text, ";
	}
	if(isset($data['category'])) {
		$query .= "category=:category, ";
	}
	if(isset($data['type'])) {
		$query .= "type=:type, ";
	}
	if(isset($data['published'])) {
		$query .= "published=:published, ";
	}
	if(isset($data['activated'])) {
		$query .= "activated=:activated, ";
	}
	if(isset($data['earn_type'])) {
		$query .= "earn_type=:earn_type, ";
	}
	if(isset($data['reward_amount'])) {
		$query .= "reward_amount=:reward_amount, ";
	}
	if(isset($data['lock_price'])) {
		$query .= "lock_price=:lock_price, ";
	}
	if(isset($data['access_level'])) {
		$query .= "access_level=:access_level, ";
	}
	$query = substr($query, 0, -2);
	$query .= " WHERE content_id=$contentId";
	$stmt = $this->database->prepare($query);
	if(preg_match("/:publisher_id/", $query)) {
		$stmt->bindParam(':publisher_id', $data['publisher_id']);
	}
	if(preg_match("/:title/", $query)) {
		$stmt->bindParam(':title', $data['title']);
	}
	if(preg_match("/:description/", $query)) {
		$stmt->bindParam(':description', $data['description']);
	}
	if(preg_match("/:full_text/", $query)) {
		$stmt->bindParam(':full_text', $data['full_text']);
	}
	if(preg_match("/:category/", $query)) {
		$stmt->bindParam(':category', $data['category']);
	}
	if(preg_match("/:type/", $query)) {
		$stmt->bindParam(':type', $data['type']);
	}
	if(preg_match("/:published/", $query)) {
		$stmt->bindParam(':published', $data['published']);
	}
	if(preg_match("/:activated/", $query)) {
		$stmt->bindParam(':activated', $data['activated']);
	}
	if(preg_match("/:earn_type/", $query)) {
		$stmt->bindParam(':earn_type', $data['earn_type']);
	}
	if(preg_match("/:reward_amount/", $query)) {
		$stmt->bindParam(':reward_amount', $data['reward_amount']);
	}
	if(preg_match("/:lock_price/", $query)) {
		$stmt->bindParam(':lock_price', $data['lock_price']);
	}
	if(preg_match("/:access_level/", $query)) {
		$stmt->bindParam(':access_level', $data['access_level']);
	}
	$stmt->execute();
  }
  
   
   /**
   * Securing text before it is loading to user, specifically html tags. 
   */
   public function render($text) {
	$text = htmlentities($text);
	return $text;
   }
   /**
   * Returns a list of writing along with its details based on the type you are associating with.
   * @param $type The column name from g0g1_writing in which will return writing from. 
   * @param $id The id to check within column value.
   * @param $page the page to get content for, in order to have smooth viewing
   * @param $limit maximum writing to display per page
   * @param $orderT the order type, specified by column name to order by
   * Example: getDetailBy('user_id', 5); This would return all writing created by the user with ID 5.
   */
   public function getDetailBy($type, $id, $page=1, $limit=10, $orderT='content_id') {
	$start = ($page * $limit)-$limit;
	$query = "SELECT content_id, publisher_id, created, title, description, full_text, category, tags, type, published, activated, earn_type, reward_amount, lock_price, unlock_count, views, access_level FROM g0g1_writing WHERE $type = $id ORDER BY $orderT ASC LIMIT $start,$limit"; 
	$row = $this->database->query($query);
	$result = $row->fetchAll();
	for($c=0; $c<sizeof($result); $c++) {
		$result[$c]['title'] = $this->render($result[$c]['title']);
		$result[$c]['description'] = $this->render($result[$c]['description']);
		$result[$c]['full_text'] = $this->render($result[$c]['full_text']);
		$result[$c]['full_text'] = $this->render($result[$c]['full_text']);
		$result[$c]['description'] = $this->render($result[$c]['description']);
	}
	return $result; 
   }   
   
   /**
   * Returns array containing list of valid writing types. This would involve content such as "essays/tutorials/story" and so on.
   */
   public function getWritingTypes() {
	$query = "SELECT * FROM g0g1_writing_type";
	$row = $this->database->query($query);
	$result = $row->fetchAll();
	return $result; 
   }
   
   public function getTotalViews($userId) {
	$writingDetail = $this->getDetailBy('publisher_id', $userId);
	$views = 0; 
	foreach($writingDetail as $key => $value) {
		$views +=$value['views'];
	}
	return $views;
   }
   
   public function getTotalUnlocks($userId) {
	$writingDetail = $this->getDetailBy('publisher_id', $userId);
	$unlocks = 0; 
	foreach($writingDetail as $key => $value) {
		$unlocks +=$value['unlock_count'];
	}
	return $unlocks;
   }

//SETTER FUNCTIONS
   /**
   * Edits database value of specified writing to set is as unlocked. This will let the reader view it.  
   * @param $userId The id of user who is unlocking content
   * @param $contentId Id of writing that is being set to unlocked
   */
   public function unlockContent($userId, $contentId) {
      $time = time(); //For generating timestamp. 
      $contentData = $this->getDetailBy('content_id', $contentId);
      $unlockCount = $contentData[0]['unlock_count']; //Get current number of unlocks.
      $unlockCount++; //Add 1 to unlock amount.
      $query1 = "INSERT INTO g0g1_locking (content_id, unlocked_by, time) VALUES ('$contentId', '$userId', '$time')";
      $this->database->query($query1);
      $query2 = "UPDATE g0g1_writing SET unlock_count = '$unlockCount' WHERE content_id = '$contentId'";
      $this->database->query($query2);
   }
   
   /**
   * Edits database to increase view count on writing when user reads it. 
   * @param $contentId The id of content to record read for
   */
   public function recordRead($contentId) {
       $content = $this->getDetailBy('content_id', $contentId);
       $views = $content[0]['views'];
       $views++;
       $query = "UPDATE g0g1_writing SET views = '$views' WHERE content_id = '$contentId'";
       $this->database->query($query);
   }
   
   /**
   * Edit database to set writing activation level to 1, meaning it is ready to be published on the site.
   * @param $contentId The id of content to activate
   */
   public function activateContent($contentId) {
       $query = "UPDATE g0g1_writing SET activated='1' WHERE content_id = '$contentId'";
       $row = $this->database->query($query);
   }
   
// CONDITIONAL FUNCTIONS: 
   /**
   * Checks to see if content is set to unlocked for specified user
   * @param $contentId the id of content to check
   * @param $userId the id of user in which to associate with lock_price
   * @return boolean true or false
   */
   public function isUnlocked($contentId, $userId) {
       $query = "SELECT * FROM g0g1_locking WHERE content_id = '$contentId' AND unlocked_by = '$userId'";
       $row = $this->database->query($query);
       $result = $row->fetch();
       if(!empty($result)) { //If no content was found return false. 
           return true;
       } else {
           return false;
       }
   }

   //Get the content's activation level. Where 1 = activate, and 0 = unactivated.
   public function isActivated($contentId) {
       $query = "SELECT activated FROM g0g1_writing WHERE content_id = '$contentId'";
       $row = $this->database->query($query);
       $result = $row->fetchColumn();
       if($result==1) {
           return true;
       } else {
           return false;
       }
   }
}
?>
