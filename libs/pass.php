<?php
Class Pass { 
	public $replace = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	public function __construct() {
		$this->database = new Database();
	}
	
	/**
	* The mighty geek encryption technique
	* Steps:
	* 1) Switch password to backwards equivilent
	* 2) Replace every character of password with ascii equivilent
	* 3) Replace every occurance of the #1, with the word 'cat'.
	* 4) md5 the heck out of this
	* 5) Crypt the md5 by supplying salt. The salt is the sha1'd and md5 version of md5 used to crypt the md5 pass.
	*/
	public function encrypt($raw) {
		$pass = strrev($raw);
		$asciiPass = null;
		for($c=0; $c<strlen($pass); $c++) {
			$asciiPass .= ord($pass[$c]);
		}
		$pattern = "/1/";
		$catPass = preg_replace($pattern, 'cat', $asciiPass, -1);
		$md5 = md5($catPass);
		$crypt = crypt(md5(sha1($md5)), $md5);
	}
}
?>