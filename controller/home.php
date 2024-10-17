<?php
// Home controller

// Includes required models
require_once("model/Subject.php");

// Prepare data for the view
$subject = new Subject();
$subjectList = $subject->getLastSubjectsByLastActivity();

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "subjectList" => $subjectList
];

// Set page meta data
App::setPageTitle("Home");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("home", $varToInject);
