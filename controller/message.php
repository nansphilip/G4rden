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

// Prepare data for the view
try {
    $userList = User::getAll();
    $messageList = Message::getAllMessageJoinedToUser();
} catch (Exception $e) {
    error_log("Message -> " . $e->getMessage());
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
