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


    <!-- Todo: donner des noms sur le boutons de chaque formulaire pour les récupérer dans le JS-->
    <!-- Todo: transmettre l'id de l'utilisateur au JS dans un attribut HTML 'data-id' -->
    <div class="pt-2 flex flex-column gap-2">
        <div class="rounded-box" post="">
            <h3 class="pb-1">Username</h3>
            <form id="username-edit" class="flex flex-row justify-between gap-2">
                <input type="text" id="username-input" class="input-form" value="<?= $user->username; ?>">
                <button type="submit" class= "w-fit-content submit-button" name="updateUsername">Mettre à jour</button>
            </form>
        </div>
        <div class="rounded-box" post="">
            <h3 class="pb-1">Firstname</h3>
            <form id="firstname-edit" class="flex flex-row justify-between gap-2">
                <input type="text" id="firstname-input" class="input-form" value="<?= $user->firstname; ?>">
                <button type="submit" class= "w-fit-content submit-button" name="updateFirstname">Mettre à jour</button>
            </form>
        </div>
        <div class="rounded-box" post="">
            <h3 class="pb-1">Lastname</h3>
            <form id="lastname-edit" class="flex flex-row justify-between gap-2">
                <input type="text" id="lastname-input" class="input-form" value="<?= $user->lastname; ?>">
                <button type="submit" class= "w-fit-content submit-button" name="updateLastname">Mettre à jour</button>
            </form>
        </div>
    </div>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
