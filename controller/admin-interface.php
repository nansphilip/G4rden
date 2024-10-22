<?php
// Admin interface controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "./model/User.php";

// Prepare data for the view
$usersList = User::getAllUsernames();
$datalist = "";
//For each username in databse, add an option to the datalist
foreach($usersList as $user){
    $username = $user['username'];
    $datalist .= "<option value=\"$username\"></option>";
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "LIST_USERNAMES" => $datalist,
];

// Set page meta data
App::setPageTitle("Admin interface");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
//App::loadCssFiles(["utils","admin_interface"]);
App::loadJsFiles(["admin-interface"]);
App::loadViewFile("admin-interface", $varToInject);
