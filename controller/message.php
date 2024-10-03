<?php
// Message controller
//Checks if the user is logged, else redirect to sign in page
if (!isset($_SESSION['userLogged']) || $_SESSION['userLogged'] !== true) {
    header("Location: index.php?p=sign_in");
}

// Includes required models
require_once "model/User.php";
require_once("model/Message.php");

// Prepare data for the view
$userList = User::getAll();
$messageList = Message::getAllMessageJoinedToUser();

// List of variables to inject in the view
$varToInject = [
    // "userList" => $userList,
    // "messageList" => $messageList,
    //"userMessageList" => $userMessageList
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
