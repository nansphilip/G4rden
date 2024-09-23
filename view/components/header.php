<?php
// Header for each page
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta data -->
    <title><?= App::$pageTitle; ?></title>
    <meta name="description" content="<?= App::$pageDescription; ?>">
    <link rel="icon" href="<?= App::$pageFavicon; ?>">

    <!-- Styles -->
    <?php if (is_array(App::$cssFiles)) {
        foreach (App::$cssFiles as $file) {
            echo "<link rel='stylesheet' href='$file'>";
        }
    } ?>

    <!-- Scripts -->
    <?php if (is_array(App::$jsFiles)) {
        foreach (App::$jsFiles as $file) {
            echo "<script src='$file'></script>";
        }
    } ?>
</head>

<body>