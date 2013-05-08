<?php
/**
* Manages user sessions when browsing the site. 
* These sessions contain page-to-page information that may be transferred accordingly 
* through $_SESSION variables
*/
class Session {

        /**
        * Calls session_start() function and simply prepares to deal with sessions
        */
	public static function start() {
		session_start();
	
	}
	
	/**
        * Takes two parameters used to create session variable by setting the data
	* @param $key The name of session
	* @param $value The data in which is stored within session. 
	* Example: $key = 'userid', $value ='5'. 
	* This sets the userid session to 5 (assuming that is the users id). 
        */
	public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	/**
        * Gets the data associated with specified session variable name
	* @param $key The session to get information from
        */
	public static function get($key) {
		return $_SESSION[$key];
	
	}
	
	/**
        * Calls session_destroy() and kills all session info currently stored.
        */
	public static function destroy() {
		session_destroy();
	}
        
        /**
        * Used a conditional function to check if a session variable is currently active. 
	* @param $key The session name in which to check activity on. 
	* Example: if userid session contains a value, the function shall return true, 
	* if it is empty the function shall return false.
        */
        public static function exists($key) {
            if(isset($_SESSION[$key])) {          
                return true;
            } else {
                return false;
            }
        }
}
?>