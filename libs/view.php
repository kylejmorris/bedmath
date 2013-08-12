<?php

/**
 * Main view used in MVC. The base of communication between controller and direct web page display.
 */
class View {

    private $frame; //Associative array containing template parts as keys, and path to file as key value. example: array('header'=>'path_to_header.php');
    
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
        $this->frame = array(            
            'main' => 'template/content/main.php',
            'mathjax' => 'template/content/mathjax.php',
            'header' => 'template/content/header.php',
            'errors' => 'template/content/errors.php',
            'view' => $this->appType . 'views/' . $page . '.php',
            'footer' => 'template/content/footer.php');
    }

    /**
     * Generates display by including main template components and dynamically including $page
     * @param $page The view to display. Made up of string data containing view folder, and file. Example: "writing/index". This will go into the /views/writing folder, and select the index.php file.
     * @param $exlude an array of values named by the template pieces..
     */
    public function render($page, $exlude = null) {
        $keys = array_keys($this->frame);
        $this->frame['view'] = $this->appType.'views/'.$page.'.php'; //since appType isn't set in constructor, have to redeclare to make path accurate.
        foreach ($keys as $key) {
            if(!in_array($key, $exlude)) {
                require $this->frame[$key];
            }
        }
    }

}

?>