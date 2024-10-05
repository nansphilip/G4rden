<?php
// Message script

require_once "./model/Message.php";

try {
    // Parameters list
    $paramList = ["replyValue", "dateValue"];

    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    $date = new DateTime($dateValue);
    $formattedDate = $date->format('Y-m-d H:i:s');

    // Add the message to the database
    $newMessage = new Message('', $replyValue, $formattedDate, $_SESSION['id']);
    $newMessage->addMessage();

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data saved with success",
        "data" => [
            "username" => $_SESSION['username'],
            "message" => $replyValue,
            "date" => $dateValue
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
