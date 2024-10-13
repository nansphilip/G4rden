<?php
// Profile update script
require_once "./model/User.php";
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if data exists
    if (is_null($data)) {
        throw new Error("No data provided");
    }

    // Parameters list
    $paramList = ["username", "firstname", 'lastname', 'password', 'passwordConfirm'];

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
    $messageUser = new Message('','','','');
    $messageUser->userId = $id;
    $messages = $messageUser->getMessagesByUserId();


    if (empty($messages)) {
        throw new Error("No messages found for this user.");
    }


    // Update data
    $user->updateUsername($data["username"]);
    $user->updateFirstname($data["firstname"]);

    $data = [
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $messages
    ];
    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => [
            "username" => $user->username, // Ajoute le nom d'utilisateur
            "messages" => $messages // Ajoute les messages
        ]
    ]);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
