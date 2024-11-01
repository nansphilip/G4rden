<?php
// Error controller

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "e" => $e,
];

// Set page meta data
App::setPageTitle("Une erreur est survenue..." . " • G4rden");
App::setPageDescription("Une erreur est survenue sur G4rden.");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("error", $varToInject);
