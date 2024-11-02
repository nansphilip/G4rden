<?php
// Theme script

try {
    // Parameters list
    $paramList = ["theme"];

    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    if ($theme !== "dark" && $theme !== "") {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid theme"
        ]);
        return;
    }

    // Set the theme
    $_SESSION['theme'] = $theme;

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data saved with success"
    ]);
} catch (Throwable $e) {
    // Get environment
    $envFile = parse_ini_file(".env");
    $ENVIRONMENT = $envFile['ENV'];

    // Check if in production
    if ($ENVIRONMENT === "DEV") {
        // Throw an error for debugging
        throw new Error($e->getMessage());
    }

    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => "can't toggle dark theme",
        "data" => null
    ]);
}
