<?php
// Home view
?>
<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Your are consulting G4rden's profile. <a href="index.php?p=home">Click here to go back home.</a></p>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
