<?php
require_once 'includes/header.php';

// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: confirm_logout.php");
exit;

require_once 'includes/footer.php';
