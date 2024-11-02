<?php

//Require the models
require_once "./model/Message.php";
require_once "./model/User.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    $paramList = ["username", "userType"];
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

    // Check if the user has already the same type
    // if ($user->userType === $userType) {
    //     throw new Error("This user is already an " . $userType);
    // }

    // Update the user type
    $admin = new Admin();
    $admin->updateUserType($user->userId, $userType);

    // Encode the data
    echo json_encode([
        'status' => 'ok',
        'message' => 'User privilege updated',
        'data' => [
            'userId' => $user->userId,
            'userType' => $userType
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
        "message" => "can't update user type",
        "data" => null
    ]);
}
