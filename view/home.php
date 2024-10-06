<?php
// Home view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Welcome to G4rden. Please <a href="index.php?p=register">register</a> or <a href="index.php?p=login">login</a> to chat.</p>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>