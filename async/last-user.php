<?php
// Last user script

require_once "./model/User.php";

try {
    // Get all users
    $userList = User::getAll();
    // Test errors with null
    // $userList = null;

    if (is_null($userList)) {
        throw new Error("user not found");
    }

    // Select the last user
    $lastUser = $userList[count($userList) - 1]['username'];

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $lastUser
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