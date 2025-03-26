<?php 

/**
 * Constant Variables
 */

error_reporting(E_ALL);
ini_set('display_errors', 'On');

/** MySQL hostname */
 define('DB_HOST', 'ls-14c2de505d60515b2af5bbf8731eda5348629be7.cw2jnstrwoxa.ap-south-1.rds.amazonaws.com');


/** Database Name */
define('DB_NAME', 'dbmaster');


/** Database User */
define('DB_USER', 'dbmasteruser');


/** Database Pass */
define('DB_PASS', 'RJaaxWTT5?#xpl3-(l-x}=zhQc9(GD9B');


define('_TABLE_NAME_', 'vivera_lp_leads');


/** Site Base URL */
// define('BASE_URL', 'https://mygate.in/scampaigns');

define('LP_NAME', 'Vivera LP');

define('EMAIL_FROM_NAME', 'Sender');
define('FROM_EMAIL', 'no-reply@abc.in');


DEFINE ('CONTACT_TO',''); //
  
 //MULTIPLE EMAIL COMMA SEPERATED  
DEFINE ('CONTACT_CC','mani.uniquely21@gmail.com');         //MULTIPLE EMAIL COMMA SEPERATED  
DEFINE ('CONTACT_BCC','');       //MULTIPLE EMAIL COMMA SEPERATED 
DEFINE ('CONTACT_SUBJECT', LP_NAME.' Registration Details');

define('LOGIN_USER', 'admin'); // Lead Tracking Dashboard Username 
define('LOGIN_PASS', '8H$3FaaX6ha'); // Lead Tracking Dashboard Password 
 
global $conn;

$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if (!$conn)
{
	 die('Could not connect: ' . mysqli_error());
}

date_default_timezone_set("Asia/Kolkata"); 

// session start
set_time_limit(0);
session_start();


// db connection
// include 'includes/class.db.php';
// $db = new db("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASS);
// $db->setErrorCallbackFunction("echo");