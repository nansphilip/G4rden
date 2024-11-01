<?php
// Message script

require_once "./model/Message.php";

try {
    // Parameters list
    $paramList = ["subjectId"];

    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    $subject = $subjectId === "null" ? null : $subjectId;

    // Get all users
    $limit = 20;
    $message = new Message();
    $messageList = $message->getLastMessageJoinedToUser($subject, $limit);

    // If no messages are found, throw an error
    if (is_null($messageList)) {
        throw new Error("Message list is empty");
    }

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
        "message" => "cannot fetch messages",
        "data" => null
    ]);
}
