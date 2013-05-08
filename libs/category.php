<?php
/**
* Manages content sorting within site components by assigning certain features into suitable categories/topics. 
*/
class Category {
	public function __construct() {
		$this->database = new Database();
	}
	
	/**
	* Return number of active categories for site content.
	*/
	public function getNumberOfCategories() {
		$count = $this->database->getCount('g0g1_category', '');
		return $count;
	}
	
	/**
	* Return categories and their data
	*/
	public function getCategories() {
		$columns = array('id', 'order', 'cat_id', 'name');
		return $this->database->getAll('g0g1_category', $columns);
	}
	
	/**
	* Return category name based on id supplied
	* @param $id the category id.
	*/
	public function getNameFromId($id) {
		$category = $this->database->getRow('g0g1_category', array('name'), array('cat_id'=>$id));
		return $category['name'];
	}
}
?>