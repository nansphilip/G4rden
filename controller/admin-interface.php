<?php
// Admin interface controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active']) || !isset($_SESSION['userType']) || $_SESSION['userType'] !== "ADMIN") {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "./model/User.php";

// Prepare data for the view
$admin = new Admin();
$usernameList = $admin->getAllUsername();

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "usernameList" => $usernameList,
];

// Set page meta data
App::setPageTitle("Admin");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("leaf.png");

// Load the view
//App::loadCssFiles(["utils","admin_interface"]);
App::loadJsFiles(["admin-interface"]);
App::loadViewFile("admin-interface", $varToInject);
