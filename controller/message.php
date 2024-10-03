<?php
// Message controller
// Checks if the user is logged, else redirect to sign in page
$env = parse_ini_file(".env");
$PATH = $env['PATH'];
if (!isset($_SESSION['userLogged']) || !$_SESSION['userLogged']) {
    header('Location: ' . $PATH . 'index.php?p=sign_in');
}

// Includes required models
require_once "model/User.php";
require_once("model/Message.php");

// Check if the form has been submitted
if (isset($_POST['new_message'])) {

    $message = $_POST['reply'];
    error_log("Message : " . $message);

    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d H:i:s');
    error_log("Date : " . $formattedDate);

    $newMessage = new Message('', $message, $formattedDate, 1);

    $newMessage->addMessage();
}

// Prepare data for the view
try {
    $userList = User::getAll();
    $messageList = Message::getAllMessageJoinedToUser();
} catch (Exception $e) {
    throw new Exception("Message Controller -> " . $e->getMessage());
}

// List of variables to inject in the view
$varToInject = [
    "userMessageList" => $messageList
];

// Set page meta data
App::setPageTitle("Message");
App::setPageDescription("G4rden chat");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["message", "utils"]);
App::loadJsFiles(["message"]);
App::loadViewFile("message", $varToInject);
