<?php

/**
 * Index router
 * Redirects requests to the corresponding controller,
 * and handles errors not previously handled.
 */
try {
    // Environment
    define('ENVIRONMENT', getenv('ENV'));

    // Imports
    require_once "includes/App.php";
    require_once "includes/Database.php";

    // Router
    if (isset($_GET['p'])) {
        // Page request
        $page = $_GET['p'];
    } else if (isset($_GET['a'])) {
        // Ajax request
        $page = $_GET['a'];
    } else {
        // Default page
        $page = 'home';
    }

    // Select a controller
    $controllerPath = "controller/$page.php";

    // Call the controller
    if (file_exists($controllerPath)) {
        // Start session
        // session_start();

        // Load the controller
        require_once ($controllerPath);
    } else {
        // Throw an error
        throw new Exception("Error 404: oh no... This page doesn't exist.");
    }

} catch (Exception $e) {

    // Display the error only in development environment
    if (ENVIRONMENT == 'DEV') {
         echo $e->getMessage();
    } else {
        // Todo : test this controller
        require_once "controller/error.php";
    }
}