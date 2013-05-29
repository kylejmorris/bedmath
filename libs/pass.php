<?php
Class Pass { 
        private $raw; 
	public $replace = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	public function __construct($userId) {
		$this->database = new Database();
	}
	
        /**
         * Compares users current hashed password, with a hashed version of the input provided.
         * Return True, if passwords math, false otherwise.
         */
        public function isValid($userId, $raw) {
            if($userId!=null && $raw!=null) {
                $first = $this->secure($userId, $raw); //secure current pass with users salt
                $second = $this->getCurrent($userId); //Get users current pass
                echo $first.'<br>'.$second;
                if($first==$second) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
        
        /**
         * Creates new password by hashing raw password using new salt as well. 
         */
        public function secure($userId, $raw) {
            $salt = $this->getSalt($userId);
            if($salt!=null) {
                return sha1($salt.$raw);
            } else {
                echo 'no salt';
            }
        }
        
        /**
         * Return current hashed password of user, 
         */
        public function getCurrent($userId) {
            $row = $this->database->getRow('g0g1_users', array('password'), array('user_id'=>$userId));
            return $row[0];
        }
        
        /**
         * Returns users salt used on password. -1 if doesn't exist.
         */
        public function getSalt($userId) {
            $row = $this->database->getRow('g0g1_users', array('salt'), array('user_id'=>$userId));
            if(sizeof($row[0])==0) {
                return null;
            } 
            return $row[0];
        }
        
        /*
         * Update the salt associated with useres password. 
         */
        public function updateSalt($userId) {
            $salt = $this->genSalt();
            $this->database->update('g0g1_users', array('salt'=>$salt), array('user_id'=>$userId));
        }
        
        /*
         * Creates a salt for new hash generation
         */
        public function genSalt() {
            return openssl_random_pseudo_bytes(32);
        }
        
        /**
         * Takes raw pass and provided salt to hash.
         */
        public function genPass($raw, $salt) {
            return sha1($salt.$raw);
        }
        
        /**
         * Creates new salt and hashes raw password supplied, assuming this is a new record.
         */
        public function setNewPass($raw, $salt) {
            
        }
}
?>