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
    $PATH = isset($envFile['PATH']) ? $envFile['PATH'] : '';

    // Imports
    require_once "includes/App.php";
    require_once "includes/Database.php";

    // Router
    if (isset($_GET['p'])) {
        // Page request
        $page = $_GET['p'];
        // Select a controller
        $filePath = "controller/$page.php";
    } else if (isset($_GET['a'])) {
        // Ajax request
        $page = $_GET['a'];
        // Select an async script
        $filePath = "async/$page.php";
    } else {
        // Default page
        $filePath = "controller/home.php";
    }

    // Call the controller
    if (file_exists($filePath)) {
        // Start session
        session_start();

        // Load the controller
        require_once($filePath);
    } else {
        // Throw an error
        throw new Error("404");
    }
} catch (Throwable $e) {
    error_log("Global error -> " . $e->getMessage());
    require_once "controller/error.php";
}
