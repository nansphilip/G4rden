<?php
// Home controller

// Includes required models
require_once("model/Subject.php");

// Prepare data for the view
$subject = new Subject();
$subjectList = $subject->getLastSubjectsByLastActivity();

$formattedSubjectList = [];

foreach ($subjectList as $index => $subject) {
    
    // Type date
    $date = new DateTime($subject['lastMessageDate']);

    // Format date
    $formatter = new IntlDateFormatter(
        'fr_FR',
        IntlDateFormatter::NONE,
        IntlDateFormatter::NONE,
        date_default_timezone_get(),
        IntlDateFormatter::GREGORIAN
    );

    // Set a pattern and format the date
    $formatter->setPattern('d MMM');
    $formattedDate = $formatter->format($date);

    $formatter->setPattern('H');
    $formattedHour = $formatter->format($date);

    $formatter->setPattern('m');
    $formattedMinute = $formatter->format($date);

    // Format subject data
    $formattedSubjectList[$index] = [
        'subjectId' => $subject['subjectId'],
        'name' => $subject['name'],
        'description' => $subject['description'],
        'creatorId' => $subject['creatorId'],
        'creatorName' => $subject['creatorName'],
        'lastMessage' => $subject['lastMessage'],
        'lastMessageAuthor' => $subject['lastMessageAuthor'],
        'lastMessageDate' => $formattedDate,
        'lastMessageTime' => $formattedHour . 'h' . $formattedMinute
    ];
}

// List of variables to inject in the view
$varToInject = [
    "ENVIRONMENT" => $ENVIRONMENT,
    "PATH" => $PATH,
    "subjectList" => $formattedSubjectList
];

// Set page meta data
App::setPageTitle("Home");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadViewFile("home", $varToInject);
