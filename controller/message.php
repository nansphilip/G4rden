<?php
// Message controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
];

// Set page meta data
App::setPageTitle("Message");
App::setPageDescription("G4rden chat");
App::setPageFavicon("world.png");

// Load the view
App::loadJsFiles(["message"]);
App::loadViewFile("message", $varToInject);
