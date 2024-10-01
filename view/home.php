<?php
// Home view
?>

<?php
// Includes the header
require_once ("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Welcome to G4rden. <a href="index.php?p=message">Click here to chat.</a></p>
</main>

<?php
// Includes the footer
require_once ("view/components/footer.php");
?>