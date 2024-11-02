<?php

//Require the models
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    $paramList = ["pieceOfMessage"];
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    // Create the user object
    $message = new Message();
    $messageList = $message->getMessagesByPieceOfContent($pieceOfMessage);

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $messageList
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
        "message" => "can't fetch messages",
        "data" => null
    ]);
}