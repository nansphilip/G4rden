<?php
// Subscribe controller

// Includes required models
require_once("model/User.php");

// Check if a form has been submitted
if (isset($_POST['subscribe'])) {
    try {
        // Field list to sanitize
        $formDataList = ['lastname', 'firstname', 'username', 'password', 'passwordConfirm'];

        // Sanitize data and destructure variables
        foreach ($formDataList as $dataName) {
            ${$dataName} = htmlspecialchars($_POST[$dataName], ENT_QUOTES, 'UTF-8');
        }

        // If password is not ok, return null
        if (!(strlen($password) >= 8) || ($password != $passwordConfirm)) {
            throw new Exception("Invalid password");
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Instantiate the user
        $newUserPrototype = new User('', $lastname, $firstname, $username, $hashedPassword, 'USER');

        // Check if the username already exists
        $newUser = $newUserPrototype->getUserByUsername();

        // If the username already exists, return null
        if (is_null($newUser)) {
            throw new Exception("Username already exists");
        }

        // Creates the user in the database
        $newUser->addUser();

        // Return the username
        $newUser->username;
    } catch (Exception $e) {
        throw new Exception("Subscribe Controller -> " . $e->getMessage());
    }
}

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Subscribe");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
// App::loadJsFiles(["subscribe"]);
App::loadViewFile("subscribe", $varToInject);
