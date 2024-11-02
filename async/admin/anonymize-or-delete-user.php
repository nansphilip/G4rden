<?php

//Require the models
require_once "./model/User.php";
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    $paramList = ["username", "action"];
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    // Verify if the user exists
    $user = new User();
    $userData = $user->getUserByUsername($username);
    if (is_null($userData)) {
        throw new Error('User does not exist');
    }

    // Fill current user instance with the data
    $user->fillUserInstance($userData);

    // Update the user type
    $admin = new Admin();

    // Anonymize user and keep messages, or delete user and its messages
    if ($action === 'anonymisation') {
        // Generate a random anonyme username
        $randomAnonymeUsername = "anonymized-" . md5(rand(100, 999));
        $anonymeData = $admin->getUserByUsername($randomAnonymeUsername);

        // While anonyme username already exists, generate another one
        while (!is_null($anonymeData)) {
            $randomAnonymeUsername = "anonymized-" . md5(rand(100, 999));
            $anonymeData = $admin->getUserByUsername($randomAnonymeUsername);
        }

        // Anonymise user username
        $admin->anonymiseUser($user->userId, $randomAnonymeUsername);
        $actionRealized = "Utilisateur et messages anonymisés";
    } else if ($action === 'deletion') {
        $admin->deleteUserById($user->userId);
        $actionRealized = "Utilisateur et messages supprimés";
    }

    // Encode the data
    echo json_encode([
        'status' => 'ok',
        'message' => 'User and messages updated',
        'data' => [
            'action' => $actionRealized
        ]
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
        "message" => "can't update user and messages",
        "data" => null
    ]);
}
