<?php

/**
 * Index router
 * Redirects requests to the corresponding controller,
 * and handles errors not previously handled.
 */
try {
    // Environment
    $envFile = parse_ini_file(".env");
    $ENVIRONMENT = $envFile['ENV'];
    $PATH = $envFile['PATH'];

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
    $controller = "controller/$page.php";

    // Call the controller
    if (file_exists($controller)) {
        // Start session
        session_start();

        // Load the controller
        require_once($controller);
    } else {
        // Throw an error
        throw new Error("404");
    }
} catch (Error $e) {
    error_log("Global error -> " . $e->getMessage());
    require_once "controller/error.php";
}
