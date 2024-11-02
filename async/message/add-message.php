<?php
// Message script

require_once "./model/Message.php";

try {
    // Parameters list
    $paramList = ["content", "date", "subjectId"];

    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        ${$param} = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    // Get the subject
    $subject = $subjectId === "null" ? null : $subjectId;

    // Get date in UTC +0 timezone
    $dateTime = new DateTime($date);
    $formattedDate = $dateTime->format('Y-m-d H:i:s');

    // Add the message to the database
    $newMessage = new Message();
    $newMessage->addMessage($content, $formattedDate, $_SESSION['userId'], $subject);

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data saved with success",
        "data" => $newMessage
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
        "message" => "can't add messages",
        "data" => null
    ]);
}
