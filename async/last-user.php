<?php
// Last user script

require_once "model/User.php";

try {
    $userList = User::getAll();
    $lastUser = $userList[count($userList) - 1];

    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched",
        "data" => $lastUser['username']
    ]); 
} catch (Throwable $e) {
    // http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Login Controller -> " . $e->getMessage(),
        "data" => null
    ]);
}
