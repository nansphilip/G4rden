<?php
// Message controller

// Checks if the user is logged, else redirect to login page
$env = parse_ini_file(".env");
$PATH = $env['PATH'];
if (!isset($_SESSION['active'])) {
    header('Location: ' . $PATH . 'index.php?p=login');
}

// Includes required models
require_once "model/User.php";
require_once("model/Message.php");

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
App::loadCssFiles(["utils"]);
App::loadViewFile("message", $varToInject);
