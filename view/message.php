<?php
// Message view 
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
        // print_r($userList);
        // print_r($messageList);
        // print_r($userMessageList);
        ?>
    </pre>

    <?php
    foreach ($userMessageList as $userMessage) {
        $username = $userMessage['username'];
        $message = $userMessage['message'];
        $date = $userMessage['date'];
    ?>
        <div class="rounded-box">
            <div class="flex flex-row justify-between">
                <h3><?= $username; ?></h3>
                <p><?= $date; ?></p>
            </div>
            <p><?= $message; ?></p>
        </div>
    <?php } ?>

</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>