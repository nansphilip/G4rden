<?php // Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <button id="last_user_button">Get last user</button>
</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>