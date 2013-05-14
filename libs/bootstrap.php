<?php
/*
@author Kyle Morris
Default class to be called in order to direct the framework further. Crucial decisions are made here in which determine what, why, and when certain aspects of the site will be generated. 
*/
class Bootstrap {
	private $url; //current page url 
	private $controller; //Name of controller
	private $model; //Name of model
	private $method; //Function/method to call from controller
	private $arg; //First argument passed to method
	private $arg2;// second argument passed to method
	private $arg3;// third  argument passed to method
	private $arg4; //4th argument passed to method
	private $arg5; //Fifth argument passed to method
	private $controllerPath; //File path to controller to load.
	public $appType; //The application approach, if set as "mod" the backend will load
	
	public function __construct() {
		$GLOBALS['error'] = new Error(); //The allmighty globalized error object, in a convienient global variable. 
	}
	public function init() {
		$this->parseUrl(); 
	}
	
	public function loadController() {
	$this->controllerPath = $this->appType.'controllers/'.$this->controller.'.php'; //Typical file to be included for accessing controller
		if(!empty($this->controller)) {
			if(file_exists($this->controllerPath)) { //Check to see if controller file is created.
				require $this->controllerPath; 
				$this->controller = new $this->controller;  
				$this->controller->view->appType = $this->appType;  //Assign apptype to let view know where to find display files
			} else {
				
				require 'controllers/error.php';
				$this->controller = new Error(); 
			} 
		} else {
			require $this->appType.'controllers/index.php';
			$this->controller = new Index();  
			$this->controller->view->appType = $this->appType; //Assign apptype to let view know where to find display files
			$this->controller->index(); //By default call index method from controller if nothing else is specified
		}
	}
	
	public function loadModel() {
		if($this->appType=='backend/') {
			$this->controller->loadModel($this->appType, $this->url[1]); //Calling loadmodel method from controller, giving appType as parameters to let Model know where to search for files. Example: the admin models are not located in the same directory as main models. Also sending controller name as second param to load.  
			if(!empty($this->method)) {
				$this->controller->{$this->method}($this->arg, $this->arg2, $this->arg3, $this->arg4, $this->arg5); //Calling specified method within controller, feeding what ever arguments were given within url 
			} else {
				$this->controller->index();
			}
		} else {	
			$this->controller->loadModel($this->appType, $this->url[0]); //Calling loadmodel method from controller, giving appType as parameters to let Model know where to search for files. Example: the admin models are not located in the same directory as main models. Also sending controller name as second param to load.  
			if(!empty($this->method)) {
				$this->controller->{$this->method}($this->arg, $this->arg2, $this->arg3, $this->arg4, $this->arg5); //Calling specified method within controller, feeding what ever arguments were given within url 
			} else {
				$this->controller->index();
			}
		}
		
	}

	//Breaking up URL to determine what goes where. Notable function is checking appType to run
	public function parseUrl() {
	@$this->url = $_GET['url']; //Current URL (not including root domain name)
	//echo $this->url;
		if(!preg_match("/[^a-zA-z0-9_,\/\-]/", $this->url)){
                                $this->url = str_replace(',', '', $this->url);
				$this->url = explode('/', $this->url); //Break apart url at / points
				//print_r($this->url);
				if($this->url[0]=='mod') { //the url to enter in order to activate backend. example: globeofgeek.com/lol
				$this->appType = 'backend/'; //set the app type as backend for staff. 
				@$this->controller = $this->url[1]; //Controlleris equal to array element 0
				@$this->method = $this->url[2];  // Method is equal to array element 1
				@$this->arg = $this->url[3]; // Method argument is equal to array element 2
				@$this->arg2 = $this->url[4]; //Method argument is equal to array element 3. This isn't often needed
				@$this->arg3 = $this->url[5]; //Method argument is equal to array element 3. This isn't often needed
				@$this->arg4 = $this->url[6];
				@$this->arg5 = $this->url[7];
			} else { //Load normal front end site application
				$this->controller = $this->url[0]; //Controlleris equal to array element 0
				@$this->method = $this->url[1];  // Method is equal to array element 1
				@$this->arg = $this->url[2]; // Method argument is equal to array element 2
				@$this->arg2 = $this->url[3]; //Method argument is equal to array element 3. This isn't often needed
				@$this->arg3 = $this->url[4]; //Method argument is equal to array element 3. This isn't often needed
				@$this->arg4 = $this->url[5];
				@$this->arg5 = $this->url[6]; 
			}
		} else {
			echo 'Invalid url';
		}
	}
}

?>