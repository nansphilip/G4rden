<?php
// Message script

require_once "./model/Message.php";

try {
    // Get all users
    $limit = 10;
    $messageList = Message::getLastMessageJoinedToUser($limit);

    if (is_null($messageList)) {
        throw new Error("Cannot fetch messages");
    }

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $messageList
    ]);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
?>