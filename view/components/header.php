<?php
// Header for each page
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php // Header for each page 
    ?>
    <title><?= App::$pageTitle; ?></title>
    <meta name="description" content="<?= App::$pageDescription; ?>">
    <link rel="icon" href="<?= App::$pageFavicon; ?>">

    <?php // Styles 
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="static/css/global.css">
    <link rel="stylesheet" href="static/css/arrow_to_top.css">
    <?php if (is_array(App::$cssFiles)) {
        foreach (App::$cssFiles as $file) {
            echo "<link rel='stylesheet' href='$file'>";
        }
    } ?>

    <?php // Scripts 
    ?>
    <script src="static/js/global.js"></script>
    <?php if (is_array(App::$jsFiles)) {
        foreach (App::$jsFiles as $file) {
            echo "<script src='$file' type='module'></script>";
        }
    } ?>
</head>

<body>

    <header>
        <h1 class="logo-title"><?= "<a href={$PATH}/index.php?p=home>G4rden</a>" ?></h1>
        <nav class="nav-bar">
            <?="<a href={$PATH}/index.php?p=home>Home</a>" ?>
            <?="<a href={$PATH}/index.php?p=last-user>Last user</a>" ?>
            <?php
            // Sets the navigation bar depending if the user is logged in or not
            if (isset($_SESSION['active'])) {
                echo "<a href={$PATH}/index.php?p=message>Message</a>";
                echo "<a href={$PATH}/index.php?p=logout>Logout</a>";
            } else {
                echo "<a href={$PATH}/index.php?p=login>Login</a>";
                echo "<a href={$PATH}/index.php?p=register>Register</a>";
            }
            ?>
        </nav>
    </header>