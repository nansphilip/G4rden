<?php

//Require the models
require_once "./model/Message.php";
require_once "./model/User.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    //Sanitize data 
    if(!isset($data['username']) || !isset($data['selectValue'])) throw new Error("A parameter is missing");
    $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');
    $selectValue = htmlspecialchars($data['selectValue'], ENT_QUOTES, 'UTF-8');

    // create the object user
    $userObject = new User('', '', '', $username, '', '');

    //Verify if the user exists, if username not found return message not found
    $user = $userObject->getUserByUsername();
    if (is_null($user)) {
        throw new Error('User not found for : ' . $username);
    }
    $userId = $user['id'];
    $userType = $user['userType'];

    //Create the admin object
    $admin = new Admin('', '', '', '', '', '');

    //Check if the update has to be called for the user or if the user type is already the same
    if($userType == $selectValue){
        throw new Error("User type already set to " . $selectValue);
    }
    //Update the user type
    $query = $admin->updateUserType($userId, $selectValue);
    if(!$query){
        throw new Error("Error updating user type");
    } else {
        $data = ['status' => 'ok', 'message' => 'User privilege set to ' . $selectValue . ' for ' . $username];
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
?>