<?php

// Subscribe controller

// Includes required models
require_once("model/User.php");

// Check if a form has been submitted
if (isset($_POST['subscribe'])) {
    $isUserCreated = createUser();
}

function createUser()
{
    // Field list to sanitize
    $formDataList = ['lastname', 'firstname', 'username', 'password', 'passwordConfirm'];

    // Sanitize data and destructure variables
    foreach ($formDataList as $dataName) {
        ${$dataName} = htmlspecialchars($_POST[$dataName], ENT_QUOTES, 'UTF-8');
    }

    // If password is not ok, return null
    if (!(strlen($password) >= 8) || ($password != $passwordConfirm)) {
        error_log("Password is not ok");
        return null;
    }

    // Instantiate the user
    $newUser = new User('', $lastname, $firstname, $username, $password, 'USER');
    $isUserAvailable = $newUser->isUsernameAvailable($username);

    // If the username already exists, return null
    if (!$isUserAvailable) {
        error_log("Username already exists");
        return null;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Creates the user in the database
    $newUser->addUser($hashedPassword);

    // Return the username
    return $newUser->username;
}

// Prepare data for the view


// List of variables to inject in the view
isset($isUserCreated)
    ? $varToInject = ["username" => $isUserCreated]
    : $varToInject = [];

// Set page meta data
App::setPageTitle("Subscribe");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
// App::loadJsFiles(["subscribe"]);
App::loadViewFile("subscribe", $varToInject);
