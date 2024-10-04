<?php

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "model/User.php";



$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH
];

// Set page meta data
App::setPageTitle("Profile");
App::setPageDescription("G4rden Profile");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
App::loadViewFile("profile", $varToInject);
?>