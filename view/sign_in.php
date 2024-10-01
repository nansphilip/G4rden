<?php // Message view 
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Enter your username or email and your password to sign in. <a href="index.php?p=home">Click here to go back home.</a></p>

    <pre>
        <?php
        // print_r($userList);
        // print_r($messageList);
        // print_r($userMessageList);
        ?>
    </pre>

    
    <?php
    require_once("view/components/sign_in_form.php");
    ?>


</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>