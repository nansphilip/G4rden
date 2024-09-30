<?php // Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Your are consulting G4rden's chat. <a href="index.php?p=home">Click here to go back home.</a></p>

    <pre>
        <?php
        // print_r($lastUser);
        ?>
    </pre>

    <button onclick="console.log('getLastUser')">Get last user</button>

</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>