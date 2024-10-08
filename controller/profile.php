<?php

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "model/User.php";

// Get id from session
$id = $_SESSION['id'];

// Create a new user object from the id
$user = new User();
$user->getUserById($id);

$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "user" => $user,
];

// Set page meta data
App::setPageTitle("Profile");
App::setPageDescription("G4rden Profile");
App::setPageFavicon("world.png");

// Load the view
App::loadJsFiles(["profile", "AsyncRouter"]);
App::loadCssFiles(["utils"]);
App::loadViewFile("profile", $varToInject);
?>