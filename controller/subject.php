<?php
// Subject controller

// Checks if the user is logged, else redirect to login page
if (!isset($_SESSION['active'])) {
    header("Location: {$PATH}/index.php?p=login");
}

// Includes required models
require_once("model/Subject.php");
require_once("model/Message.php");
require_once("model/User.php");

// Checks get parameters is set
if (!isset($_GET['id'])) {
    throw new Error("404");
}

// Get the subject
$subject = new Subject();
$subjectArray = $subject->getSubjectById(htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'));

// If no subject is found, throw an error
if (is_null($subjectArray)) {
    throw new Error("404");
}

// Prepare data for the view
$subject->fillSubjectInstance($subjectArray);

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "subject" => $subjectArray
];

// Set page meta data
App::setPageTitle("Sujets : " . $subject->name . " • G4rden");
App::setPageDescription("Sujets de discussions sur le forum G4rden.");
App::setPageFavicon("leaf.png");

// Load the view
App::loadJsFiles(["message"]);
App::loadViewFile("subject", $varToInject);
