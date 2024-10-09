<?php
// Last user script
session_start();

require_once "./model/User.php";

// try {
    // Get all users
    $userList = User::getAll($userId);
    // Test errors with null
    // $userList = null;

//    if (is_null($userList)) {
        throw new Error("User not found");
//    }

    // Selection du user de la session en cours
    $userId = $_SESSION['user_id'];

    $currentUser = User::getUserById();

    // récupère le nom du user
    $username = $currentUser['username'];

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => $currentUser
    ]);
// } catch (Throwable $e) {

    // 
//    throw new Error("Profile update -> " . $e->getMessage());
    
    // Return an error to the client
//   echo json_encode([
//        "status" => "error",
 //       "message" => $e->getMessage(),
//        "data" => null
 //   ]);
//}
?>