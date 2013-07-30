<?php

/**
 * Class handles errors generated upon user interaction with the framework. Errors may be stored, logged, and then rendered for frontview display.
 */
class Error {

    /**
     * Array list of error types that are allowed. Such as user errors, form errors, etc. . . .
     */
    private $errorTypes;
    /**
     * Multidimentional-Array containing errors to display.
     * Structure: mainArray[error[]];
     * The main array will hold all of the individual errors, which are also arrays. 
     * The error array will hold elements: 
     * (0 = 'error type(example: user error, form error', 1 = 'message', 2 = 'display type' < this is for css loading style.);
     */
    private $errorList;

    /**
     * This will be a multidimentional array where the index is the error type [form][user] gathered from variable $errorTypes.
     * The value it holds will be an array of errors under the set type. 
     * These errors are generated from different parts of the site, and then displayed accordingly. 
     * The index names are most commonly the objects in the framework, however some exceptions may occur. 
     */
    private $errors;

    public function __construct() {
        $this->errorList = array();
        $this->errorTypes = array('form', 'user', 'points', 'question', 'answer', 'mail');
        $this->errors = array(
            'form' => array(),
            'user' => array(),
            'points' => array(),
            'question' => array(),
            'answer' => array(),
            'mail' => array()
        );
    }

    /**
     * Add a new error to process during page request. 
     * @param $type the type of error being generated.
     * @param $text string value containing error message.
     */
    public function addError($errorType, $text, $displayType = 'default') {
        $newError = array($errorType, $text, $displayType);
        array_push($this->errorList, $newError);
        $cType = $this->getErrorTypes();
        if (in_array($type, $cType)) {
            array_push($this->errors[$errorType], $text);
        }
    }

    /**
     * Returns generated error count, allows specification of error type. 
     */
    public function getErrorCount($type = 'all') {
        $count = 0;
        if ($type == 'all') {
            foreach ($this->errorTypes as $type) {
                for($c=0; $c<=sizeof($this->errorList); $c++) {
                    if($this->errorList[$c][0]==$type) {
                        $count++;
                    }
                }
            }
            return $count;
        } else {
            foreach($this->errorList as $error) {
                if($error[0]==$type) {
                    $count++;
                }
            }
            return $count;
        }
    }

    /**
     * Renders errors for display on frontend.
     */
    public function showErrors() {
        $output = '';
        $types = $this->getErrorTypes();
        $index = 0; //counting messages within each type.
        for($c=0; $c<sizeof($this->errorList); $c++) {
            $output.='<div class=error>'.$this->errorList[$c][0].' '.$this->errorList[$c][1].'</div>';
        }
        return $output;
    }

    /**
     * Returns the error types acceptable for generation.
     */
    public function getErrorTypes() {
        return $this->errorTypes;
    }

}

?>