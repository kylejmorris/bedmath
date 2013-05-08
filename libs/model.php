<?php
/**
* Main model used in MVC. 
* The base of communication between controller and database. 
* Controls business logic and parents individual component models that extend to it. 
*/
class Model {
	/**
	* Object of database allowing access to mysql and extension to PDO class
	*/
	public $database;
	
	/**
	* Creates new database object
	*/
	public function __construct() {
		$this->database = new Database();
	}
}

?>