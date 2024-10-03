<?php
// Sign in controller

// Includes required models
require_once("model/User.php");

// Check if a form has been submitted
if (isset($_POST['signIn'])) {
    $isUserCreated = createUser();
}

function createUser()
{
    $formDataList = ['username', 'password'];

    // Sanitize data and destructure variables
    foreach ($formDataList as $dataName) {
        ${$dataName} = htmlspecialchars($_POST[$dataName], ENT_QUOTES, 'UTF-8');
    }

    // Create the object newUser
    $userPrototype = new User('', '', '', 'username', 'password', '');

    // Check if the username exists
    $user = $userPrototype->getUserByUsername();

    // If the username does not exists, return null
    if (is_null($user)) {
        error_log("Username already exists");
        return null;
    }

    // Check if the password is correct
    $isPasswordCorrect = password_verify($password, $userPassword);

    // If the password is not correct, return null
    if (!$isPasswordCorrect) {
        echo "Les informations de connexion sont incorrectes";
        error_log("Les informations de connexion sont incorrectes.");
        return null;
    }


    // Add user data to the session
    foreach ($user as $props => $value) {
        $_SESSION[$props] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    // Define user logged
    $_SESSION['userLogged'] = true;

    // Redirect to the home page
    header("Location: index.php?p=home");
}


// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Sign In");
App::setPageDescription("G4rden chat");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["message", "utils"]);
App::loadJsFiles(["message"]);
App::loadViewFile("sign_in", $varToInject);
