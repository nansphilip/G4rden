<?php
// Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>

<main class="flex flex-column overflow-y-hidden">
    <h2 class="bold"><?= $subject['name']; ?></h2>
    <p class="mb-2"><?= $subject['description']; ?></p>

    <section
        id="chatContainer"
        data-user-id="<?= $_SESSION['userId'] ?>"
        data-subject-id="<?= $subject['subjectId'] ?>"
        class="flex-1 flex flex-column gap-2 overflow-y-auto padding-shadow">
        <div class="blur-gradient"></div>
        <!-- Messages will be injected here -->
    </section>

    <div class="padding-shadow">
        <form id="addNewMessage" method="post" action="" class="mt-2 flex flex-column gap-1 rounded-box">
            <label class="bold" for="reply">Répondre</label>
            <div class="flex pb-1 flex-row gap-2">
                <input
                    id="reply"
                    name="reply"
                    minlength="1"
                    maxlength="3000"
                    class="input-form"
                    placeholder="Écrire un message..."
                    required
                    autofocus
                    aria-label="Écrire un message">
                </input>
                <button type="submit" class="w-fit-content submit-button" name="new_message" aria-label="Envoyer le message">↑</button>
            </div>
        </form>
    </div>

    <?php
    // Includes the footer
    require_once "view/components/footer.php";
    ?>