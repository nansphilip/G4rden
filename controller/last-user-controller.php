<?php
// Last user controller

// Includes required models
require_once "model/User.php";
// $lastUser = Admin::getLastUser();

// Prepare data for the view


// List of variables to inject in the view
$varToInject = [
    // "lastUser" => $lastUser,
];

// Set page meta data
App::setPageTitle("Last user");
App::setPageDescription("G4rden last user created");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
App::loadJsFiles(["last-user"]);
App::loadViewFile("last-user", $varToInject);