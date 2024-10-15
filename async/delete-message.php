<?php

//Require the models
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data 
    if (!isset($data['idMessage'])) throw new Error("A parameter is missing");
    $idMessage = htmlspecialchars($data['idMessage'], ENT_QUOTES, 'UTF-8');

    // Create the object message
    $messageObject = new Message($idMessage, '', '', '');

    // Verify that the message exists
    $message = $messageObject->getMessageById();
    if (is_null($message)) {
        throw new Error("Message not found");
    }

    // Delete the message by its id
    $delete = $messageObject->deleteMessage();
    if ($delete) {
        $data = ['status' => 'ok', 'message' => 'Message deleted'];
    } else {
        throw new Error("Error deleting message");
    }

    // Encode the data
    echo json_encode($data);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
