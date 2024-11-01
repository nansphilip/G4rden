<?php

//Require the models
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    $paramList = ["messageId"];
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    // Verify that the message exists
    $message = new Message();
    $messageData = $message->getMessageById($messageId);
    if (is_null($messageData)) {
        throw new Error("Message not found");
    }

    // Delete the message
    $message->deleteMessageById($messageId);

    // Encode the data
    echo json_encode([
        'status' => 'ok',
        'message' => 'Message deleted',
        'data' => [
            'messageId' => $messageId
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
        "message" => "can't delete message",
        "data" => null
    ]);
}
