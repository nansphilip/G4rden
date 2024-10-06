<?php
// Home controller

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH
];

// Set page meta data
App::setPageTitle("Home");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("home", $varToInject);
?>