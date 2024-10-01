<?php
// Sign in controller

// Includes required models
require_once("model/User.php");

// Check if the sign in form has been submitted
if (isset($_POST['signIn'])) {
    $isUserCreated = createUser();
}

function createUser(){

    //Sanitize the data
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    //Create the object admin
    $admin = new Admin('1', '', '', 'admin', 'admin', 'ADMIN', '');

    $userPassword = $admin->getUserPasswordByUsername($username);
    $userId = $admin->getUserIdByUsername($username);

    //Gets all user data for SESSION
    $user = $admin->getUserById($userId);

    //$admin->deleteUser('1');

    //Check if the password is correct
    if (password_verify($password, $userPassword)) {
        //Insert user data onto his session
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userFirstname'] = $user['firstname'];
        $_SESSION['userLastname'] = $user['lastname'];
        $_SESSION['userType'] = $user['userType'];
        $_SESSION['userLogged'] = true;

        //Redirect to the home page
        header("Location: index.php?p=home");
    } else {
        echo "Les informations de connexion sont incorrectes";
        error_log("Les informations de connexion sont incorrectes.");
        return null;
    } 
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
