<?php
// Profile update script
require_once "./model/User.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if data exists
    if (is_null($data)) {
        throw new Error("No data provided");
    }

    // Parameters list
    $paramList = ["usernafme", "firstname", 'lastname'];

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) {
            throw new Error("A parameter is missing");
        }
        $data[$param] = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    // Get id from session
    $id = $_SESSION['id'];

    // Create a new user object from the id
    $user = new User();
    $user->getUserById($id);

    // Update the username
    $user->updateUsername($data["username"]);

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $user->username
    ]);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
