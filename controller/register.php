<?php
// Register controller

// Checks if the user is logged, else redirect to login page
if (isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=message");
}

// Includes required models
require_once("model/User.php");

// Check if a form has been submitted
if (isset($_POST['register'])) {
    try {
        // Field list to sanitize
        $fieldList = ['lastname', 'firstname', 'username', 'password', 'passwordConfirm'];

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

        // Instantiate the user
        $newUser = new User('', $lastname, $firstname, $username, $passwordHash, 'USER');

        // Check if the username already exists
        $isAvailable = $newUser->getUserByUsername();

        // If the username already exists, return null
        if (isset($isAvailable)) {
            throw new Error("Username already exists");
        }

        // Creates the user in the database
        $newUser->addUser();

        // Get the new user data from the database
        $getNewUser = $newUser->getUserByUsername();

        // Add user data to the session
        foreach ($getNewUser as $props => $value) {
            $_SESSION[$props] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        // Define user logged
        $_SESSION['active'] = true;

        // Redirect to the home page
        header("Location: {$PATH}/index.php?p=message");
    } catch (Throwable $e) {
        throw new Error("Register Controller -> " . $e->getMessage());
    }
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH
];

// Set page meta data
App::setPageTitle("Register");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("register", $varToInject);
