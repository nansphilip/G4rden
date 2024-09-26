<?php

//Check if $_POST exists and the user clicked on the submit button
if (isset($_POST['subscribe'])) {
    //Check if all fields are filled
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
        //Check if email is ok
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            //Check if password is ok
            if (!(strlen($_POST['password']) >= 8)) {
                //If password is not ok, display an error message
                echo "Your password is too short";
                exit();
            }
            //Check if passwordConfirm is ok
            if (!($_POST['password'] == $_POST['passwordConfirm'])) {
                //If passwordConfirm is not ok, display an error message
                echo "Your passwords do not match";
                exit();
            }
        } else {
            //If email is not ok, display an error message
            echo "Your email is not valid";
            exit();
        }
    }

//Banalize data
$name = htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
$surname = htmlspecialchars($_POST['surname'],ENT_QUOTES,'UTF-8');
$username = htmlspecialchars($_POST['username'],ENT_QUOTES,'UTF-8');
$mail = htmlspecialchars($_POST['mail'],ENT_QUOTES,'UTF-8');
$password = htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8');
$passwordConfirm = htmlspecialchars($_POST['passwordConfirm'],ENT_QUOTES,'UTF-8');
    
//Check if the username is available
require_once("model/User.php");
$admin = new Admin('1', 'Admin', 'Admin', 'admin', 'admin', 'ADMIN', 'admin@g4rden.com');
$isUserAvailable = $admin->getUserByUsername($username);
if ($isUserAvailable) {
    echo "Ce username est déjà utilisé";
    exit();
}

echo "Name: " . $name . "<br>";
echo "Surname: " . $surname . "<br>";
echo "username: " . $username . "<br>";
echo "Mail: " . $mail . "<br>";
echo "Password: " . $password . "<br>";
echo "PasswordConfirm: " . $passwordConfirm . "<br>";

//Check if the email is available and there is no user with the same email
$isEmailAvailable = $admin->getUserMail($mail);
if ($isEmailAvailable) {
    echo "Ce mail est déjà utilisé";
    exit();
}

//hasher le mdp 

//si tout est ok ajout user en BASE 
}
//rediriger vers la page d'accueil en étant connecté



// Subscribe controller

// Includes required models

// Prepare data for the view

// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Subscribe");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["home"]);
App::loadJsFiles(["home"]);
App::loadViewFile("subscribe", $varToInject);
?>