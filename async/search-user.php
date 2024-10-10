<?php
// Last user script

require_once "./model/User.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    //Sanitize data 
    if(!isset($data['username'])) throw new Error("A parameter is missing");
    $username = htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8');

    // Get all users
    $usersList = User::getAllUsernamesByUsername($username);

    if (is_null($usersList)) {
        throw new Error("Cannot fetch users");
    }


    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $usersList
    ]);
} catch (Throwable $e) {
    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
?>