<?php

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once "model/User.php";

$id = $_SESSION['id'];

$userProfil = new User($id, '', '', '', '', '');
$userData = $userProfil->getUserById();

$lastname = $userData['lastname'];
$firstname = $userData['firstname'];
$username = $userData['username'];
$passwordHash = $userData['passwordHash'];
$userType = $userData['userType'];

$user = new User($id, $lastname, $firstname, $username, $passwordHash, $userType);


$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "userData" => $userData,
];

// Set page meta data
App::setPageTitle("Profile");
App::setPageDescription("G4rden Profile");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
App::loadViewFile("profile", $varToInject);
?>