<?php
/**
* Class handles errors generated upon user interaction with the framework. Errors may be stored, logged, and then rendered for frontview display.
*/
class Error {
	/**
	* This will be a multidimentional array where the index is the error type [form][user] gathered from variable $errorTypes.
	* The value it holds will be an array of errors under the set type. 
	* These errors are generated from different parts of the site, and then displayed accordingly. 
	* The index names are most commonly the objects in the framework, however some exceptions may occur. 
	*/
	private $errors; 
	
	public function __construct() {
		$this->errors = array(
						'form' => array(),
						'user' => array(),
						'points' => array(),
						'question' => array(),
						'answer' => array()
		);
	}
	/**
	* Add a new error to process during page request. 
	* @param $type the type of error being generated.
	* @param $text string value containing error message.
	*/
	public function addError($type, $text) {
		$cType = $this->getErrorTypes();
		if(in_array($type, $cType)) {
			array_push($this->errors[$type], $text);
		}
	}
	
	/**
	* Returns generated error count, allows specification of error type. 
	*/
	public function getErrorCount($type='all') {
		if($type=='all') {
			$count = 0;
			foreach($this->errors as $type) {
				$count+=sizeof($type);
			}
			return $count;
		} else {
			return sizeof($this->errors[$type]);
		}	
	}
	
	/**
	* Renders errors for display on frontend.
	*/
	public function showErrors() {
		$output = '';
		$types = $this->getErrorTypes();
		$index = 0; //counting messages within each type.
		foreach($types as $type) {
			while($index<sizeof($this->errors[$type])) {
				$output.='<b>'.ucfirst($type).':</b> '.$this->errors[$type][$index].'<br>'; 
				$index++;
			}
			$index=0;
		}
		return $output; 
	}	
	
	/**
	* Returns the error types acceptable for generation.
	*/
	public function getErrorTypes() {
		return array_keys($this->errors);
	}
}
?>