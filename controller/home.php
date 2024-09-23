<!-- Home controller -->

<?php
// Includes required models

// Prepare data for the view

// Set page meta data
App::setPageTitle("Home");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["home", "global"]);
App::loadJsFiles(["home", "global"]);
App::loadViewFile("home");
?>