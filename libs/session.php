<?php

/**
 * Manages user sessions when browsing the site. 
 * These sessions contain page-to-page information that may be transferred accordingly 
 * through $_SESSION variables
 * NOTE: A session hash is required before utilizing most of this class. Call the default Session::get() method to return PHPSESSID value. 
 */
class Session {

    /**
     * Calls session_start() function and simply prepares to deal with sessions
     */
    public static function start() {
        session_start();
    }

    /**
     * Returns row, if session exists in database. If not, return false.
     * @param $sessionId The hashed session value associated with active session.
     * @param $type the type of session, such as 'logged_in'.
     */
    public static function sessionInDb($sessionId) {
        $database = new Database();
        $count = $database->getCount('g0g1_sessions', array('session_id' => $sessionId, 'active'=>1));
        if ($count != 0) {
            return true;
        }
        return false;
    }

    /**
     * Checks if session is expired, returning true or false accordingly.
     */
    public static function isExpired($sessionId) {
        $database = new Database();
        $row = $database->getRow('g0g1_sessions', array('expires'), array('session_id' => $sessionId));
        echo $row['expires'];
        if ($row['expires'] <= time()) {
            return true;
        }
        return false;
    }

    /**
     * Deactivates record of session in database, and removes any $_SESSION value associated.
     * @param $sessionId the id of session in database to remove.
     */
    public static function kill($sessionId) {
        $database = new Database();
        $database->update('g0g1_sessions', array('active'=>false), array('session_id'=>$sessionId));
        $_SESSION['loggedin'] = false;
        session_regenerate_id();
    }

    /**
     * Update current record in database with new session id/information to assist in preventing session hijacking.
     * @param $sessionId the id of session to rebuild
     * @pre Assume session exists, and is properly associated. 
     */
    public static function rebuildSession($sessionId) {
        $database = new Database();
        $expires = time() + SESSION_LENGTH;
        session_regenerate_id();
        $newSessionId = session_id();
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $columns = array('session_id' => $newSessionId, 'ip' => $ip, 'useragent' => $userAgent, 'active' => true, 'expires' => $expires);
        $database->update('g0g1_sessions', $columns, array('session_id' => $sessionId));
    }

    /**
     * Creates a new session with the type provided.
     * @param $type the type of session to create, used as array key in $_SESSION[''
     * @param $value the value to hold within session.
     * @param $subject the id of user, or item using this session. 
     * @param $expires integer of how many seconds until session expires.
     * @pre No session exists causing a duplicate. 
     */
    public static function create($type, $value, $subject) {
        $database = new Database();
        $expires = time() + SESSION_LENGTH;
        $_SESSION[$type] = $value;
        $sessionId = session_id();
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $columns = array('session_id' => $sessionId, 'type' => $type, 'ip' => $ip, 'useragent' => $userAgent, 'active' => true, 'user_id' => $subject, 'expires' => $expires);
        $database->insertRow('g0g1_sessions', $columns);
        $_SESSION['loggedin'] = true;
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

    public static function getId() {
        return session_id();
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
        if (isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }

}

/**
 * Logical planning:
 * Use get() to get main session id if it exists
 * Upon page loading that requires sessions, call sessionInDb() to determine if session exists. 
 * Call isExpired() to determine if session is active, or needs to be set to inactive. 
 * If session is completely valid, rebuild it's data. 
 */
?>

