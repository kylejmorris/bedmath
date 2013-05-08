<?php
/**
* Lists information regarding content categories and navigation to the content in which they hold.
*/
class Category extends Controller {
    function __construct() {
        parent::__construct();
        $this->pagination = new Pagination();
    }
    
    //The default page in which will direct user to select the article or video categories. 
    public function index() {
        header("Location:".ROOT.'category/writing/'); //redirect to writing, index page is placeholder for now.
    }

    /**
    * Main page for article categories. 
    * If the user doesn't specify a category id in url, then a category list will be displayed. 
    * @param $cat_id The category to view writing from 
    * @param $page The page to load content on, allowing smooth viewing
    * @param $limit Max amount of written content to load per page
    * @param $order order type of content, such as ordering by authorname
    */
    public function writing($cat_id, $page, $limit, $order) {
        if(!empty($cat_id)) {
		if(empty($page)){$page=1;}
		if(empty($limit)){$limit=10;}
		if(empty($order)){$order='content_id';}
		$writing = $this->model->writing($cat_id, $page, $limit, $order); //Calling model to create page info.   
		$this->view->pagination = $this->pagination->getPageList($page, $limit, $this->model->writingPagination($cat_id));
		$this->view->list = $writing;
		$this->view->cat_id = $cat_id;
		$this->view->page = $page;
		$this->view->limit = $limit;
		$this->view->order = $order;
		$this->view->thumbWidth = 50; //width of thumbnail image describing content
		$this->view->thumbHeight = 50; //Height of thumbnail image describing content.
		$this->view->render('category/writing_list');
        } else {
		$category = $this->model->getCategories($cat_id); 
		$this->view->category = $category;
		$this->view->width = 100; //Width of image displayed as category icon
		$this->view->height = 100; //Height of image displayed as category icon.
		$this->view->render('category/writing_categories');
        }
        
    }
}
?>