<?php

//Require the models
require_once "./model/User.php";
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Sanitize data 
    if (!isset($data['usernameAuthor'])) throw new Error("A parameter is missing");
    $username = htmlspecialchars($data['usernameAuthor'], ENT_QUOTES, 'UTF-8');
    if (!isset($data['keyMessage'])) throw new Error("A parameter is missing");
    $keyMsg = htmlspecialchars($data['keyMessage'], ENT_QUOTES, 'UTF-8');

    // Create the user object
    $userObject = new User('', '', '', $username, '', '');
    $user = $userObject->getUserByUsername();
    $userId = $user['id'];

    // Get all the messages corresponding to key message and user
    $messagesTab = Message::getMessagesByUserAndContent($userId, $keyMsg);

    // Get all the messages corresponding to key message
    // $messagesTab = Message::getMessagesByPeaceOfContent($keyMsg);

    if (is_null($messagesTab)) {
        throw new Error("No messages found for the search.");
    }

    $data = [
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $messagesTab
    ];
    // create the object user
    // $userObject = new User('', '', '', $username, '', '');

    // Verify if the user exists
    // If username not found return message not found
    // $user = $userObject->getUserByUsername();
    // if (is_null($user)) {
    //     $data = ['status' => 'error', 'message' => 'User not found for : ' . $username];
    // } else {
    //     //Update all his messages with a user named "user_deleted"
    //     $userId = $user['id'];
    //     $data = updateMessages($userId);

    //     // Delete the user by its username
    //     $delete = $userObject->deleteUserByUsername($username);
    //     if ($delete) {
    //         $data = ['status' => 'ok', 'message' => 'User deleted'];
    //     } else {
    //         $data = ['status' => 'error', 'message' => 'Error deleting user'];
    //     }
    // }

    // Encode the data
    echo json_encode($data);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
