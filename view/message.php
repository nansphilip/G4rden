<?php
// Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>



<main class="flex flex-column gap-2 overflow-y-hidden">
    <div>
        <h2><?= App::$pageTitle; ?></h2>
        <p>Your are consulting G4rden's chat. <a href="index.php?p=home">Click here to go back home.</a></p>
    </div>

    <div id="directChat" class="flex-1 flex flex-column gap-1 overflow-y-auto">
        <!-- Messages will be injected here -->
        <?php foreach ($userMessageList as $userMessage) {
            $username = $userMessage['username'];
            $message = $userMessage['message'];
            // Todo : date en français ?
            $date = date_format(new DateTime($userMessage['date']), 'j M');
            $time = date_format(new DateTime($userMessage['date']), 'H:i');
        ?>
            <div class="rounded-box">
                <div class="flex flex-row justify-between">
                    <h3><?= $username; ?></h3>
                    <div class="flex flex-row items-center gap-1">
                        <p><?= $date; ?></p>
                        <p>•</p>
                        <p><?= $time; ?></p>
                    </div>
                </div>
                <p><?= $message; ?></p>
            </div>
        <?php } ?>
    </div>

    <form method="post" action="" class="bg-gray-light flex flex-column items-center gap-2 rounded-box">
        <label class="w-full bold" for="reply">Répondre</label>
        <textarea
            id="reply"
            name="reply"
            rows="3"
            minlength="1"
            maxlength="3000"
            class="w-full"
            placeholder="Écrire un message..."
            required></textarea>
        <button type="submit" class="w-fit-content" name="new_message">Répondre</button>
    </form>

</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>