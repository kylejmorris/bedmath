<?php

/**
 * Handles html form data.
 * @author Kyle Morris
 */
class Form {
    /**
    * Holds array containing form names/data.
    * @var array[]
    */
    private $formData; //Holds array sent to methods, manipulates data.
	
	/**
	* All mighty variable containing all form data and their conditions. These conditions may or may not be included for each form element.
	* Structure:
	* 			required: boolean representing if form element is requiring data 
	* 			min_length: the minimal length of element
	*			max_length: the maximume length of element
	*			email_valid: boolean representing if email supplied is in correct format
	*			username_exists: boolean checking if username inputted exists or not. 
	*			is_numeric: value in form element is only numbers, none of that other garbage.
	*			min_value: numeric value is greater than the amount specified. 
	*/
	private $data; 
    
	/**
	*  List of string element names, such as 'username', 'password'. These are used to individually store within arrays rather than guessing index values.
	*/
	private $eNames;
	/**
	* Sets default form information prior to parsing/validating. 
	* @param $formArray an array containing form elements, along with their specifications.
	*/
	public function __construct($formArray=null) {
		$this->data = $formArray;
		$this->email = new Email(); //Email object used to validation of email form data.
		$this->user = new User();
	}
	
	/**
	* Currently under construction, will replace getFormContent() by allowing security validation through each form element individually using associative array.
	*/
	public function getFormData() {
		$formData = array(''); //Creating blank array to work with. 
		foreach($this->eNames as $element) { //Run through element names
			$formData[$element] = $_POST[$element]; //
		}
		return $formData;
	}
	
	/**
	* Runs scan on form elements for validity
	* @return true if all valid, false if not. Will generate errors in Alert object to display to user. 
	*/
	public function isValid() {
		$this->eNames = array_keys($this->data); //Getting string version of element names for further processing. 
		$index = 0; //Counting $elementNames in order to properly gather form element name in string form
		foreach($this->data as $element) {
			$value = $this->getElementValue($this->eNames[$index]);
			if(isset($element['required'])) { //Is 'required' a condition for this field
					if($element['required']==true) { //Field is required
						if(strlen($value)<=0) {
							$GLOBALS['error']->addError('form', $this->eNames[$index].' is required');
						} 
					}
			}
			if(isset($element['min_length'])) {
				if(strlen($value)<$element['min_length']) {
					$GLOBALS['error']->addError('form', $this->eNames[$index].' must be over '.$element['min_length'].' characters long.');
				}
			}
			if(isset($element['max_length'])) {
				if(strlen($value)>$element['max_length']) {
					$GLOBALS['error']->addError('form', $this->eNames[$index].' must be under '.$element['max_length'].' characters long.');
				}
			}
			if(isset($element['email_valid'])) {
				if($this->email->isValidEmail($value)==false) {
					$GLOBALS['error']->addError('form', $this->eNames[$index].' must be valid email format');
				}
			}
			if(isset($element['username_exists'])) {
				if($this->user->usernameExists($value)==false) {
					$GLOBALS['error']->addError('form', 'The user specified does not exist.');
				}
			}
			if(isset($element['is_numeric'])) {
				if(is_numeric($value)==false) {
					$GLOBALS['error']->addError('form', $this->eNames[$index].' must be numbers only.');
				}
			}
			if(isset($element['min_value'])) {
				if($value<$element['min_value']) {
					$GLOBALS['error']->addError('form', $this->eNames[$index].' must be at least '.$element['min_value']);
				}
			}
			$index++; //Allowing navigation to next element name
		}
		if($GLOBALS['error']->getErrorCount('form')+$GLOBALS['error']->getErrorCount('user')==0) { //Only returning succesfull if no errors have occured. 
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* Checks through PHP superglobals to find form in which form data was sent.
	*/
	public function getElementValue($element) {
		if(isset($_POST[$element])) {
			return $_POST[$element];
		}
		if(isset($_GET[$element])) {
			return $_GET[$element];
		}
		if(isset($_FILES[$element])) {
			return $_FILES[$element];
		}
	}
	
    /**
    * Runs through array getting data from form, checks to see what type of data is being fed firstly.
    * If a file was uploaded, it will determine this and store $_FILE[] value inside of the array, 
    * rather than $_POST or $_GET. Returns array containing same index names, 
    * but now associated with data that was sent from the form. 
    * @param $formArray The form data stored in an associative array, where index is form element name, and value is the data within that element
    */
    function getFormContent($formArray) {
        $this->formData = $formArray; //Setting form data in object
        foreach($formArray as $index => $value) { //Run through each form element
			if(isset($_POST[$index])) { //Checking if element is $_POST 
				$value = $_POST[$index]; //Set value to form field holding name of array index
				$this->formData[$index] = $value;  //Transfer value into main object variable
			} 
			if(isset($_FILES[$index])) { //Check to see if field is submitted as file upload.
				if($this->isRequired($index)) {
					$value = $_FILES[$index]; //Get file information and store in value
					$this->formData[$index] = $value;  //Transfer value into main object variable
				} else {
					
				}
			}
        }
        return $this->formData; //returns array data
    }
}
?>
