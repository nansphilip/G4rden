<?php
// Last user controller

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH
];

// Set page meta data
App::setPageTitle("Last user");
App::setPageDescription("G4rden last user created");
App::setPageFavicon("world.png");

// Load the view
App::loadJsFiles(["last-user"]);
App::loadViewFile("last-user", $varToInject);
