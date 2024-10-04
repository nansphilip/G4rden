<?php
// Last user script

require_once "./model/User.php";

try {
    $userList = User::getAll();
    $userListLength = count($userList);
    $lastUser = $userList[$userListLength - 1]['username'];

    error_log("Last user : " . $lastUser);
    error_log("Last user type : " . gettype($lastUser));

    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched",
        "data" => $lastUser
    ]); 
} catch (Throwable $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Last user script -> " . $e->getMessage(),
        "data" => null
    ]);
    throw new Error("Last user script -> " . $e->getMessage());
}
