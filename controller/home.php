<?php
// Home controller

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Home");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["home"]);
App::loadJsFiles(["home"]);
App::loadViewFile("home", $varToInject);
?>