<?php
// Message controller

// Includes required models
require_once("model/User.php");
$userList = Admin::getAll();

require_once("model/Message.php");
//$messageList = Message::getAll();

//Test de getAllMessages 
$messageList = Message::getAllMessageJoin();

// Prepare data for the view

// Associate the messages with the users
// foreach ($messageList as $message) {
//     foreach ($userList as $user) {
//         if ($user['id'] == $message['user_id']) {
//             $username = $user['username'];
//             break;
//         } else {
//             $username = "Unknown";
//         }
//     }

//     // Rewrite the message list with the corresponding username
//     $userMessageList[] = [
//         "id" => $message['id'],
//         "username" => $username,
//         "message" => $message['content'],
//         "date" => date_format(new DateTime($message['date']), 'j F Y')
//     ];
// }

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
