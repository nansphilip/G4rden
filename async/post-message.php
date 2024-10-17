<?php
// Message script

require_once "./model/Message.php";

try {
    // Parameters list
    $paramList = ["content", "date"];

    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    $dateTime = new DateTime($date);
    $formattedDate = $dateTime->format('Y-m-d H:i:s');

    // Add the message to the database
    $newMessage = new Message();
    $newMessage->addMessage($content, $formattedDate, $_SESSION['userId']);

    $databaseMessage = $newMessage->fillMessageById($newMessage->messageId);

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data saved with success",
        "data" => $databaseMessage
    ]);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
