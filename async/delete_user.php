<?php
header('Content-Type: application/json');
define('ENVIRONMENT', getenv('ENV'));

// Imports
require_once "../includes/Database.php";
require_once "../model/User.php";
require_once "../model/Message.php";
//$input = json_decode(file_get_contents('php://input'), true);
//$username = isset($input['username']) ? $input['username'] : null;

$username = isset($_GET['username']) ? $_GET['username'] : null;
//$username = "theo";
$userObject = new User('', '', '', $username, '', '');

//If username not found return message not found
if (is_null($userObject->getUserByUsername())) {
    $data = ['message' => 'User not found for : ' . $username];
} else {
    //Update all his messages with a user named "user_deleted"
    $user = $userObject->getUserByUsername();
    $userId = $user['id'];

    updateMessages($userId);
}

function deleteUser($username){
    // if($userObject->deleteUserByUsername($username)){
    //     $data = ['message' => 'User ' . $username . ' deleted successfully.'];
    // }else {
    //     $data = ['message' => 'User ' . $username . ' not deleted.'];
    // }
}

function updateMessages($userId){
    //Update all the user messages by setting new author "deleted user"
    $messageObject = new Message('', '', '', $userId);
    //The user user_deleted has userId 6
    $update = $messageObject->updateAllAuthorMessages('6');
    if($update){
        $data = ['update' => 'messages updated'];
    } else {
        $data = ['update' => 'error updating'];
    }
}


    // if(is_null($user)){
    //     $data = ['message' => 'User not found for : ' . $username];
    // }
    // if($user){
    //     $data = ['message' => 'User ' . $username . ' deleted successfully.'];
    // }
//}
echo json_encode($data);
?>