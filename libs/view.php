<?php
/**
* Main view used in MVC. The base of communication between controller and direct web page display.
*/
class View {

	private $error; //For rendering errors.
    /**
    * Name of template that will be rendered for user. 
    * It will be added to file name as: /templates/css/.'$template'
    */
    private $template = '1.css'; 
    
    /**
    *  Page title to display in browser header tab. This will automatically change based on the page the user is browsing
    */
    private $title = 'YOOO';
    
    /**
    * The app type to load. 
    * If set as backend for example the view will then load files from backend/view/... 
    * This is directly assigned from bootstrap
    */
    public $appType; 
    
	function __construct() {	
		
	}	
        
        
        /**
        * Generates display by including main template components and dynamically including $page
        * @param $page The view to display. Made up of string data containing view folder, and file. Example: "writing/index". This will go into the /views/writing folder, and select the index.php file.
        */
	public function render($page) {
		require 'template/content/header.php';
		require 'template/content/main_nav.php';
		require 'template/content/errors.php';
		require 'template/content/main.php';
		require $this->appType.'views/'.$page.'.php';
		require 'template/content/footer.php';
	}
}
?>
