<?php
/**
* Manages image content/sorting/uploading, etc.
* @author Kyle Morris
*/
class Image {
    /**
    * Main file being uploaded, array generated from upload form usually.
    * @var array
    */
    public $file; 
    
    /**
    * Name of the image being uploaded, taken from $file
    * @var string
    */
    public $name; 
    
    /**
    * Timestamp of when image is being uploaded
    * @var int
    */
    public $time;
    
    /**
    * File extension of image
    * @var string
    */
    public $ext; 
    
    /**
    * Temporary file location of image upon being uploaded.
    * @var string
    */
    public $temp;
    
    /**
    * Id specifying what type of image this is on the site. 
    * The database will associate this id with the location in which the image is displayed. 
    * Refer to database for reference to image types and their corresponding ID's
    * @var int
    */
    public $type; 
    
    /**
    * When multiple images are associated to the same content id/user id
    * they must be ordered to determine which to display first.
    * Example: In a written article, if there are 5 images associated with it, what order will they be loaded?
    * @var int
    */
    public $order = 1; 
    
    /**
    * Width of image
    * @var int
    */
    public $width; 
    
    /**
    * Height of image
    * @var int
    */
    public $height; 
    
    /**
    * Id of user, in case image is associated. Example being profile images.
    * @var int
    */
    public $userId; 
    
    /**
    * Id of content, in case image is associated. Example being submitted writing that has images. 
    * @var int
    */
    public $contentId; 
    
    /**
    * Creates user and database object
    */
    public function __construct() {
        $this->database = new Database();
        $this->user = new User();
    }
  
    /**
    * Takes file array from upload and stores information within object properties. 
    * Breaks up file name into name/extension as well.
    * @param $file The uploaded file to prepare/store 
    * @param $type The type of image. Refer to $type property.
    */
    public function prepare($file, $type) {
        $this->file = $file; //Full array of image, just in case future reference is needed
        $this->temp = $file['tmp_name'];
        $this->name = $file['name']; 
        $this->ext = explode(".", $this->name); //Breaking up file name to get just extension.
        $this->time = time(); //timestamp in which image was uploaded. 
        $this->name = $this->time.rand(1,999); //Generate new image name by getting current timestamp and appending random value
        $this->ext = $this->ext[1]; //Get file extension type (jpg/png), that type of thing. 
        $this->type = $type; //Type is integer value representing image type, can be found in database g0g1_images
    }
    
    /**
    * Uploads and moves image to designated location based on information supplied through properties. 
    * @param $userId the Id of whom is uploading image_name
    * @param $contentId the id of content image is associated with
    */
    public function uploadToContent($userId, $contentId) {
        $this->contentId = $contentId; //ID content value
        $this->userId = 15; //User who uploaded image
        $directory = IMAGE_UPLOAD_TARGET.$this->name.".".$this->ext;
        move_uploaded_file($this->temp, $directory); //Sending file to specified directory
        if($this->ext == 'jpg' || $this->ext == 'tif') { //Do additional checks on file type before upload
		$image = ImageCreateFromJPEG($directory);  //To remove meta exploitation
        }
        $this->logUpload();
    }
    
    //Moves around image and sends it to specified location. Records 
    public function uploadToProfile() {
    }
    
   
    /**
    * Called after image is successfully uploaded, 
    * this function records activity in database accordingly. 
    * No param needed, all data is located within object properties due to prepare statement being called. 
    */
    public function logUpload() {   
        //echo $this->userId.'<br>'.$this->type.'<br>'.$this->contentId.'<br>'.$this->order.'<br>'.$this->name.'<br>'.$this->ext.'<br>'.$this->time;
        $query = "INSERT INTO g0g1_image_log (id, user_id, type, content_id, image_name, file_type, upload_time) VALUES('', '$this->userId','$this->type','$this->contentId','$this->name','$this->ext','$this->time')"; 
        $this->database->query($query);
    }     

    /**
    * Grabs image information from database by supplying image type ID and user ID. 
    * Only 1 image can ever be assigned to a user and type at the same time, such as profile image etc. 
    * @param $type The type ID of image
    * @param $userId The users ID
    */
    public function getImageByUser($type, $userId) {
	$query = "SELECT * FROM g0g1_image_log WHERE type='$type' AND user_id='15'";
	$row = $this->database->query($query);
	$result = $row->fetch();
	return $result;
    }
    
    /**
    * Grabs image(s) information from database by supplying image type ID and content ID.
    * Array is returned assuming multiple rows may be found.
    * @param $type The type ID of image
    * @param $contentId The content ID
    */
    public function getImageByContent($type, $contentId) {
      $query = "SELECT * FROM g0g1_image_log WHERE type='$type' AND content_id='$contentId'";
      $row = $this->database->query($query);
      $result = $row->fetch();
      return $result;
    }
    
    public function getImagesByType($type) {
      $query = "SELECT * FROM g0g1_image_log WHERE type='$type'";
      $row = $this->database->query($query);
      $result = $row->fetchAll();
      return $result;
    }
}


?>
