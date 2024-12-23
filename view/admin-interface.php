<?php
// Admin interface view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main class="flex flex-column gap-4 overflow-y-auto padding-shadow">
    <div>
        <h2 class="bold"><?= App::$pageTitle; ?></h2>
        <p>G4rden's admin dashboard.</p>
    </div>

    <div>
        <h3 class="bold mb-1">Modifier les privilèges d'un utilisateur</h3>
        <form name="updateType" class="rounded-box flex flex-column gap-3" aria-label="Formulaire de modification des privilèges">
            <div class="flex flex-column gap-1">
                <label for="selectUsernameForUpdateType">Rechercher un utilisateur</label>
                <input
                    class="input-form"
                    list="datalist"
                    id="selectUsernameForUpdateType"
                    placeholder="Pseudo de l'utilisateur"
                    required
                    aria-label="Rechercher un utilisateur" />
                <datalist id="datalist">
                    <?php foreach ($usernameList as $username) : ?>
                        <option value="<?= $username; ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="flex flex-column gap-1">
                <label for="selectTypeForUpdateType">Sélectionner un niveau de privilèges</label>
                <select id="selectTypeForUpdateType" class="input-form pointer" required aria-label="Sélectionner un niveau de privilèges">
                    <option value="USER">Utilisateur</option>
                    <option value="ADMIN">Administrateur</option>
                </select>
                <div id="feedbackForUpdateType" class="italic bold font-sm w-full center text-success" role="status"></div>
                <div class="flex justify-center">
                    <button type="submit" class="submit-button" aria-label="Modifier les privilèges">Modifier</button>
                </div>
            </div>
        </form>
    </div>

    <div>
        <h3 class="bold mb-1">Supprimer un utilisateur</h3>
        <form name="deleteUser" class="rounded-box flex flex-column gap-3" aria-label="Formulaire de suppression d'utilisateur">
            <div class="flex flex-column gap-1">
                <label for="searchDeleteUser">Rechercher un utilisateur</label>
                <input
                    class="input-form"
                    list="datalist"
                    id="searchDeleteUser"
                    placeholder="Pseudo de l'utilisateur"
                    required
                    aria-label="Rechercher un utilisateur" />
                <datalist id="datalist">
                    <?php foreach ($usernameList as $username) : ?>
                        <option value="<?= $username; ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="flex flex-column gap-1">
                <label for="selectDeleteUser">Action à réaliser</label>
                <select id="selectDeleteUser" class="input-form pointer" required aria-label="Sélectionner une action">
                    <option value="anonymisation">Conserver ses messages et anonymiser leur auteur</option>
                    <option value="deletion">Supprimer ses messages et supprimer leur auteur</option>
                </select>
                <div id="feedbackForDeleteUser" class="italic bold font-sm w-full center text-success" role="status"></div>
                <div class="flex justify-center">
                    <button type="submit" name="deleteUser" class="submit-button mt-1" aria-label="Supprimer l'utilisateur">Supprimer</button>
                </div>
            </div>
        </form>
    </div>

    <div>
        <h3 class="bold mb-1">Supprimer un message</h3>
        <form name="deleteMessage" class="rounded-box flex flex-column gap-3" aria-label="Formulaire de suppression de message">
            <div class="flex flex-column gap-1">
                <label for="selectForDeleteMessage">Entrez un mot clé du message à rechercher</label>
                <input
                    type="text"
                    class="input-form"
                    id="selectForDeleteMessage"
                    placeholder="Mot clé"
                    required
                    aria-label="Entrez un mot clé du message à rechercher" />
                <div class="flex justify-center">
                    <button type="submit" class="submit-button mt-1" aria-label="Rechercher un message">Rechercher</button>
                </div>
                <div id="feedbackForDeleteMessage" class="italic bold font-sm w-full center text-success" role="status"></div>
            </div>
            <section id="messageContainerForDeleteMessage" name="deleteMessage" class="flex-1 flex flex-column gap-2 overflow-y-auto padding-shadow" aria-label="Liste des messages">
                <!-- Messages will be injected here -->
            </section>
        </form>
    </div>

    <div class="flex-1"></div>

    <?php
    // Includes the footer
    require_once("view/components/footer.php");
    ?>