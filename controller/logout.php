<?php
// Logout controller

// Destroy all session variables, and the session
$_SESSION = array();
session_destroy();

// Redirect to home page
header("Location: {$PATH}/index.php?p=home");
