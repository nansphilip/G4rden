<?php
// Logout controller
// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Sign In");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
//App::loadJsFiles(["home"]);
App::loadViewFile("sign_in", $varToInject);
?>