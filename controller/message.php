<?php
// Message controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once("model/Message.php");

// Check if the form has been submitted
if (isset($_POST['new_message'])) {

    // Get the message
    $message = $_POST['reply'];

    // Get the date
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d H:i:s');

    // Add the message to the database
    $newMessage = new Message('', $message, $formattedDate, $_SESSION['id']);
    $newMessage->addMessage();
}

// Prepare data for the view
try {
    $limit = 10;
    $messageList = Message::getAllMessageJoinedToUser($limit);
} catch (Throwable $e) {
    throw new Error("Message Controller -> " . $e->getMessage());
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "userMessageList" => $messageList
];

// Set page meta data
App::setPageTitle("Message");
App::setPageDescription("G4rden chat");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils", "color"]);
App::loadJsFiles(["message"]);
App::loadViewFile("message", $varToInject);
