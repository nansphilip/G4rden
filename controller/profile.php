<?php
// Profile controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "model/User.php";

// Prepare data for the view
$user = new User();
$user->getUserById($_SESSION['id']);

// Set notification
$notification = null;

// If a form is submitted
if(isset($_POST["updateInfo"])) {

    // Field list to sanitize
    $fieldList = ['username', 'firstname', 'lastname'];

    // Sanitize data and destructure variables
    foreach ($fieldList as $field) {
        ${$field} = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
    }

    // Update data if it's different from the current data
    if (!empty($username) && $username !== $user->username) { $user->updateUsername($username); }
    if (!empty($firstname) && $firstname !== $user->firstname) { $user->updateFirstname($firstname); }
    if (!empty($lastname) && $lastname !== $user->lastname) { $user->updateLastname($lastname); }

    $notification = [
        "title" => "infoUpdated",
        "message" => "Vos informations ont été mises à jour."
    ];

} else if(isset($_POST["updatePassword"])) {

    $fieldList = ['password', 'confirmPassword'];

    foreach ($fieldList as $field) {
        ${$field} = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
    }

    // If password is not ok, return null
    if (!(strlen($password) >= 8) || ($password != $confirmPassword)) {
        throw new Error("Invalid password");
    }

    $password;

    $notification = [
        "title" => "passwordUpdated",
        "message" => "Vos informations ont été mises à jour."
    ];
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "username" => $user->username,
    "firstname" => $user->firstname,
    "lastname" => $user->lastname,
    "notification" => $notification
];

// Set page meta data
App::setPageTitle("Profile");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["profile", "utils"]);
App::loadJsFiles(["profile"]);
App::loadViewFile("profile", $varToInject);