<?php
// Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>

<main class="flex flex-column gap-3 overflow-y-hidden">
    <div>
        <h2><?= App::$pageTitle; ?></h2>
        <p>Your are consulting G4rden's chat.</p>
    </div>

    <div id="directChat" data-user-id="<?= $_SESSION['userId'] ?>" class="flex-1 flex flex-column gap-2 overflow-y-auto padding-shadow">
        <!-- Messages will be injected here -->
    </div>

    <form id="addNewMessage" method="post" action="" class="flex flex-column gap-1 rounded-box">
        <label class="bold" for="reply">Répondre</label>
        <div class="flex flex-row gap-2">
            <input
                id="reply"
                name="reply"
                minlength="1"
                maxlength="3000"
                class="input-form"
                placeholder="Écrire un message..."
                required></input>
            <button type="submit" class="w-fit-content submit-button" name="new_message">↑</button>
        </div>
    </form>

</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>
