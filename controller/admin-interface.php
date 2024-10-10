<?php
// Admin interface controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
];

// Set page meta data
App::setPageTitle("Admin interface");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
//App::loadCssFiles(["utils","admin_interface"]);
App::loadJsFiles(["admin-interface"]);
App::loadViewFile("admin-interface", $varToInject);
?>