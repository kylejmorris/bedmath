<?php

/**
 * Pagination refers to the navigation of data on listed views. 
 * For example on the members page, many users would be listed if all on one page alone
 * Pagination generates a series of values representing pages
 * Example: 1...2,3,4,5,6...100. This would be the navigation from page 1-100, assuming you're on page 4 currently. 
 */
Class Pagination {
    
    protected $database;
    
    public function __construct($db) {
        if($db==null) {
            $this->database = new Database();
        } else {
            $this->database = $db;
        }
    }
    /**
     * Generates page values in which can be looped and loaded on a specified view.
     * This will only work of course, if the view supports pagination by having something such as
     * /page/id/count in the url, where these values can be specified. 
     * @param $cPage The current page user is on. Used to define middle of pagination list.
     * Example: if $cPage was 2, the list would look like: (1...$cPage, 3, 4, 5, 6...)
     * @param $display The amount of data to be displayed on page at once. 
     * @param $dataCount The total amount of data that could be accessed. 500 users' for example. 
     */
    public function getPageList($cPage, $display, $dataCount) {
        $list = array(); //Will contain page values to be displayed in pagination list. 
        $listSize = 10; //How many pages to hold in pagination list
        $start = $cPage - 5; 
        $limit = ceil($dataCount / $display); //Highest page number that would contain data.
        $c = $start; //Counter holding start value for loop generating page numbers
        //If there are very few page numbers. Less than the amount of numbers to generate
        if($limit>1) {
            $list[0] = '1, '; //Default value for beginning of page list. Most things start from 1 right?
        } else {
            $list[0] = '1 '; //Default value but with no tailing comma
        }
        for ($i = 0; $i < $listSize; $i++) {
            if ($c > 1 && $c < $limit) { //Check if starting page is positive, and below max page number
                array_push($list, $c.', ');
            }
            $c++;
        }
        if($limit>1) { //Must call this if statement twice since it needs to take place at beginning and end of array.
            $list[$listSize] = $limit; //Setting final value in page list. 
        }
        ksort($list); //Order array by element values. ex, $list[0], $list[1], $list[2] and so on.
        return $list;
    }
}

?>