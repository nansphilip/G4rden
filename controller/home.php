<?php
// Home controller
//Checks if the user is logged, else redirect to sign in page
if (!isset($_SESSION['userLogged']) || $_SESSION['userLogged'] !== true) {
    header("Location: index.php?p=sign_in");
}
// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Home");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["home"], ["backToTop"]);
App::loadJsFiles(["home"]);
App::loadViewFile("home", $varToInject);
?>