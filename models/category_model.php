<?php
class Category_Model extends Model {
    function __construct() {
        parent::__construct();
        
    }
    
    public function getCategories() {
            $query = "SELECT * FROM g0g1_category";
            $row = $this->database->query($query);
            $result = $row->fetchAll();
            return $result;
    }
    
    //Sent from writing controller, generates page data and returns 1 array
    public function writing($cat_id, $page, $limit, $order) {
       $writing = new Writing(); 
       $image = new Image();
       $user = new User(); 
       $content = $writing->getDetailBy('category', $cat_id, $page, $limit, $order); //Grabbing writing based on category.
       for($c=0; $c<sizeof($content);$c++) { //Run through loop getting image url for each piece of writing.
	array_push($content[$c], 'image_name','image_extension', 'author'); //adding image_name and image_extention to each array of content, better than using 2 separate arrays to store this info.
	$imageDetail = $image->getImageByContent( 2, $content[$c]['content_id']); //Getting array of image detail by feeding in parameters of content id.
	  if($imageDetail!=null) { //Checking to see if content has image associated with it. 
	    $content[$c]['image_name'] = $imageDetail['image_name']; //Making the newly added value of image_name on $content equal to the value stored in $imageDetail. 
	    $content[$c]['file_type'] = $imageDetail['file_type']; //Same with image_name, transferring value of imageDetail into Content
	  } else {
	    $imageDetail = $image->getImageByContent(1, 1); //Getting default placeholder image 
	    $content[$c]['image_name'] = $imageDetail['image_name']; //Transferring value of image_name
	    $content[$c]['file_type'] = $imageDetail['file_type']; //transferring value of file_type
	    echo $content[$c]['image_name'];
	  }
	  $content[$c]['author'] = $user->getNameFromId($content[$c]['publisher_id']); //Storing full username of author by feeding the userId as parameters
      }
       return $content; 
    }
    
    public function writingPagination($cat_id) {
	$query = "SELECT COUNT(*) FROM g0g1_writing WHERE category='$cat_id'";
	$stmt = $this->database->prepare($query);
	$stmt->execute();
	$count = $stmt->fetch();
	return $count[0];
    }
}
?>