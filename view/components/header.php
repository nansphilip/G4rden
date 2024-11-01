<?php
// Header for each page
?>

<!DOCTYPE html>

<html lang="fr" <?= (isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark') ? 'class="dark"' : ''; ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php // Header for each page ?>
    
    <title><?= App::$pageTitle; ?></title>
    <meta name="description" content="<?= App::$pageDescription; ?>">
    <link rel="icon" href="<?= App::$pageFavicon; ?>">

    <?php // Styles ?>

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="static/css/global.css">
    <link rel="stylesheet" href="static/css/components.css">
    <link rel="stylesheet" href="static/css/navigation.css">
    <link rel="stylesheet" href="static/css/arrow_to_top.css">
    <link rel="stylesheet" href="static/css/utils.css">

    <?php if (is_array(App::$cssFiles)) {
        foreach (App::$cssFiles as $file) {
            echo "<link rel='stylesheet' href='$file'>";
        }
    } ?>
</head>

<body class="overflow-x-hidden overflow-y-hidden">
    <header>
        <div class="flex flex-row gap-1">
            <h1><?= "<a class='bold' href={$PATH}/index.php?p=home>G4rden</a>" ?></h1>
            <img src="static/img/leaf.png" alt="Logo" class="logo">
        </div>
        <?php require_once "view/components/navigation.php"; ?>
    </header>