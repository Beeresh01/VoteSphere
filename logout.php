<?php
// logout.php - Destroy the session and redirect to login page

// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: 1stpage.php");
exit();

?>