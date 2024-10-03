<?php
// Logout controller

// Destroy all session variables, and the session
$_SESSION = array();
session_destroy();

// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Logout");
App::setPageDescription("Logout from G4rden");
App::setPageFavicon("world.png");

// Redirect to home page
$env = parse_ini_file(".env");
$PATH = $env['PATH'];
header('Location: ' . $PATH . '/index.php?p=home');
