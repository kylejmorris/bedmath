<?php
/**
 * DATABASE CONFIGURATION
 */
define('DB_HOST','localhost');
define('DB_NAME','bedmath');
define('DB_USER','root');
define('DB_PASS','testing');

/**
 * PATH CONFIGURATION
 */
define('ROOT', '/bedmath/'); // Main site domain
define('IMAGE_ROOT', 'http://localhost/bedmath/images/uploads/'); //Location in which site media/images are stored. 
define('IMAGE_UPLOAD_TARGET', '/opt/lampp/htdocs/bedmath/images/uploads/'); //When uploading image files, this is where they will go. Allows the option to instantly change upload location rather than editing other code.

/**
 * MAIL CONFIGURATION
 * Each mail name will be associated with a corresponding database mail_id.
 */
define('MAIL_TEST', 1); //Default testing mail for system. 
define('MAIL_SEND_REMINDER1', 2); //Reminder #1 for user inactivity, giving basic update on current account standing.
define('MAIL_SEND_RECOVERY', 4); //Mail sending activation code used to login to account and change password.
define('MAIL_SEND_REDEEM_ACCEPTED', 3); //Notification stating a users redeem request was accepted during review process.
define('MAIL_SEND_REDEEM_DENIED', 5); //Notification stating a users redeem request was denied during review process.
define('MAIL_SEND_INVITE', 6); //Invite sent to nonregistered emails requesting bedmath membership.
define('MAIL_SEND_ACTIVATE', 7); //For sending activation code to email.

/**
 * FLOOD CONFIGURATION
 * Settings involving spam/flood prevention, so users can't exploit certain features.
 */
/*MAIL: Max emails sent per day, based on the mail id.*/
define('FLOOD_MAIL_RECOVERY', 3); //Recovery request limit
define('FLOOD_MAIL_INVITE', 25); //Max number of invites to be sent
define('FLOOD_MAIL_ACTIVATE', 3); //Activation request limit

/**
 * SESSION CONFIGURATION
 */
define('SESSION_LENGTH', 120); //Time until a session is destroyed for inactivity. 
?>
