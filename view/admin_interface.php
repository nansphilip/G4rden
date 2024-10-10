<?php
// Admin interface view
?>

<?php
// Includes the header
require_once ("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>G4rden's admin interface.</p>
    <?php require_once ("view/components/admin_interface.php"); ?>
</main>

<?php
// Includes the footer
require_once ("view/components/footer.php");
?>