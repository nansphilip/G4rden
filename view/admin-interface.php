<?php
// Admin interface view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <div>
        <h2><?= App::$pageTitle; ?></h2>
        <p>G4rden's admin interface.</p>
    </div>

    <!-- Delete a user -->
    <div class="justify-between margin-border padding-shadow gap-3">
        <h3>Supprimer un utilisateur</h3>
        <p>Entrez le nom de l'utilisateur à supprimer.</p>
        <input type="text" class="margin" id="inputUsername" placeholder="Pseudo de l'utilisateur">
        <button type="button" class="margin w-fit-content" id="deleteUser">Supprimer</button>
        <div id="ajax"></div>
    </div>

    <!-- Delete a message -->
    <div class="justify-between margin-border padding-shadow gap-3">
        <h3>Supprimer un message</h3>
        <p>Entrez le nom de l'utilisateur</p>
        <input type="text" class="margin" id="usernameMessage" placeholder="Pseudo de l'utilisateur">
        <p>Entrez un mot clé du message à supprimer.</p>
        <input type="text" class="margin" id="inputMessage" placeholder="Mot clé">
        <button type="button" id="searchMessage">Rechercher</button>

        <div id="messages-container" class="flex-1 flex flex-column gap-2 overflow-y-auto padding-shadow">
        <!-- Messages will be injected here -->
        </div>

</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>