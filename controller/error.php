<?php
// Error controller

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = ["e" => $e];

// Set page meta data
App::setPageTitle("Error");
App::setPageDescription("G4rden error");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("error", $varToInject);
?>