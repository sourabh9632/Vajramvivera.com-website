<?php
require_once('../config.php');
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

if(isset($_REQUEST['redirect_url']))
	header("location: ".$_REQUEST['redirect_url']);
else
	header("location: index.php");
exit;
?>