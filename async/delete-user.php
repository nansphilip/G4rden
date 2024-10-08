<?php

//Require the models
require_once "./model/User.php";
require_once "./model/Message.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    //Sanitize data 
    if(!isset($data['username'])) throw new Error("A parameter is missing");
    $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');

    $selectValue = $data['selectValue'];

    // create the object user
    $userObject = new User('', '', '', $username, '', '');

    //Verify if the user exists
    //If username not found return message not found
    $user = $userObject->getUserByUsername();
    if (is_null($user)) {
        throw new Error('User not found for : ' . $username);
    }
    $userId = $user['id'];


    //Case the messages will be deleted
    if($selectValue == 'deleteMessages'){
        if(!Message::deleteAllMessagesByUserId($userId)){
            throw new Error('Error deleting all messages');
        }
        $message = "All messages of user $username deleted.<br>";
    }

    //Case the messages will be anonymized
    if($selectValue == 'updateMessages'){
        //Update all his messages with a user named "user_deleted"
        $data = updateMessages($userId);
        $message = "All messages of user $username updated.<br>";
    }
    
    // Delete the user by its username
    $delete = $userObject->deleteUserByUsername($username);
    if ($delete) {
        $message .= "User deleted successfully.<br>";
        $data = ['status' => 'ok', 'message' => $message];
    } else {
        throw new Error('Error deleting user');
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

function updateMessages($userId)
{
    //Checks if the user has messages
    $messageObject = new Message('', '', '', $userId);
    $messages = $messageObject->getMessagesByUserId();
    if (is_null($messages)) {
        $data = ['status' => 'ok', 'message' => 'No messages to update'];
        return $data;
    }

    //Update all the user messages by setting new author to "deleted user"
    $messageObject = new Message('', '', '', $userId);
    //Create the user user_deleted (for the test, the userId is 6)
    $update = $messageObject->updateAllAuthorMessages('6');
    if ($update) {
        $data = ['status' => 'ok', 'message' => 'Messages updated'];
        return $data;
    } else {
        $data = ['status' => 'error', 'message' => 'Error updating'];
        return $data;
    }
}

?>