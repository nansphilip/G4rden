<?php
// Login controller

// Checks if the user is logged, else redirect to login page
if (isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=message");
}

// Includes required models
require_once("model/User.php");

// Check if a form has been submitted
if (isset($_POST['login'])) {
    try {
        $fieldList = ['username', 'password'];

        // Sanitize data and destructure variables
        foreach ($fieldList as $field) {
            ${$field} = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }

        // Create the object newUser
        $user = new User('', '', '', $username, '', '');

        // Check if the username exists
        $existingUser = $user->getUserByUsername();

        // If the username does not exists, return null
        if (is_null($existingUser)) {
            throw new Error("User does not exist");
        }

        // Check if the password is correct
        $isPasswordCorrect = password_verify($password, $existingUser['passwordHash']);

        // If the password is not correct, return null
        if (!$isPasswordCorrect) {
            throw new Error("Invalid password");
        }

        // Add user data to the session
        foreach ($existingUser as $props => $value) {
            $_SESSION[$props] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

        // Define user logged
        $_SESSION['active'] = true;

        // Redirect to the home page
        header("Location: {$PATH}/index.php?p=message");
    } catch (Throwable $e) {
        throw new Error("Login Controller -> " . $e->getMessage());
    }
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH
];

// Set page meta data
App::setPageTitle("Login");
App::setPageDescription("G4rden chat");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("login", $varToInject);
