<?php
// Login controller

// Checks if the user is logged, else redirect to login page
if (isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=message");
}

// Includes required models
require_once("model/User.php");

// Set notification
$notification = null;

// Check if a form has been submitted
if (isset($_POST['login'])) {
    try {
        $fieldList = ['username', 'password'];

        // Sanitize data and destructure variables
        foreach ($fieldList as $field) {
            ${$field} = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }

        // Create the object newUser, and check if the username exists
        $user = new User();
        $existingUser = $user->getUserByUsername($username);

        // If the username does not exists, return null
        if (is_null($existingUser)) {
            throw new Error("User does not exist");
        }

        // Fill the current instance of object
        $user->fillUserInstance($existingUser);

        // Check if the password is correct
        $isPasswordCorrect = password_verify($password, $user->passwordHash);

        // If the password is not correct, return null
        if (!$isPasswordCorrect) {
            throw new Error("Invalid password");
        }

        // Add user data to the session
        foreach ($user as $props => $value) {
            $_SESSION[$props] = $value;
        }

        // Define user logged
        $_SESSION['active'] = true;

        // Redirect to the home page
        header("Location: {$PATH}/index.php?p=message");
    } catch (Throwable $e) {
        if ($e->getMessage() === "User does not exist" || $e->getMessage() === "Invalid password") {
            $notification = "Identifiants incorrects.";
        } else if ($ENVIRONMENT == "DEV") {
            throw new Error("Login Controller -> " . $e->getMessage());
        }
    }
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "notification" => $notification
];

// Set page meta data
App::setPageTitle("Se connecter" . " • G4rden");
App::setPageDescription("Se connecter sur le forum G4rden.");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("login", $varToInject);
