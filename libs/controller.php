<?php
/**
* Main controller used in MVC. The base of communication between view and model. 
* @author Kyle Morris
*/
class Controller{
	public $view;
	
	function __construct() {
		$this->error = new Error();
		$this->view = new View();
		//$this->user = new User();  
                Session::start();
	}
	
	/**
	* @description Loads a model by calling the name following by _model.php being concatenated. This is called by default within the index.php file of framework and does not hold much further use. 
	* @param $name Name of model to load.
	*/
	public function loadModel($appType, $name) {
		$path = $appType.'models/'.$name.'_model.php';
		if(file_exists($path)) {
			require $path;
			$modelName = $name.'_model';
			$this->model = new $modelName();
		} else {
			//echo 'Could not locate model';
		}
	}
}
?>