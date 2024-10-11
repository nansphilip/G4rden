<?php

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "model/User.php";

// Get id from session
$id = $_SESSION['id'];

// Create a new user object from the id
$user = new User();
$user->getUserById($id);

if (isset($_POST['update'])) {
    try {
        // Field list to sanitize
        $fieldList = ['password', 'passwordConfirm'];

        // Sanitize data and destructure variables
        foreach ($fieldList as $field) {
            ${$field} = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }

        // If password is not ok, return null
        if (!(strlen($password) >= 8) || ($password != $passwordConfirm)) {
            throw new Error("Invalid password");
        }
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    } catch (Throwable $e) {
        throw new Error("Register Controller -> " . $e->getMessage());
    }
}


$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "user" => $user,
];

// Set page meta data
App::setPageTitle("Profile");
App::setPageDescription("G4rden Profile");
App::setPageFavicon("world.png");

// Load the view
App::loadJsFiles(["profile", "AsyncRouter"]);
App::loadCssFiles(["utils"]);
App::loadViewFile("profile", $varToInject);
?>