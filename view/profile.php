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
    <!-- autocomplete=off permet de ne pas voir le liste de proposition de text dans l'input -->

    <div class="pt-2 flex flex-column w-fit-content gap-2">

        <form id="profile-edit" class="flex flex-column gap-2">
            <div class="rounded-box" post="">
                <label for="username" class="pb-1">Username</label>
                <br>
                <input type="text" autocomplete="off" id="username" data-id="<?= $user->id; ?>" class="input-form"
                       value="<?= $user->username; ?>">
                <br>
                <label for="firstname" class="pb-1 pt-2">Firstname</label>
                <br>
                <input type="text" autocomplete="off" id="firstname" data-id="<?= $user->id; ?>" class="input-form"
                       value="<?= $user->firstname; ?>">
                <br>
                <label for="lastname" class="pb-1 pt-2">Lastname</label>
                <br>
                <input type="text" autocomplete="off" id="lastname" data-id="<?= $user->id; ?>" class="input-form"
                       value="<?= $user->lastname; ?>">
                <br>
                <label for="password" class="pb-1 pt-2">Password</label>
                <span id="view" class="view-pw" onclick="togglePasswordVisibility('password')">
                        <img src="static/img/view.png" alt="Afficher le mot de passe">
                </span>
                <br>
                <input type="password" autocomplete="off" id="password" data-id="<?= $user->id; ?>" class="input-form"
                       value="Entrez votre mot de passe">
                <br>
                <label for="passwordConfirm" class="pb-1 pt-2">Confirm Password</label>
                <span id="hide" class="view-pw" onclick="togglePasswordVisibility('password')">
                        <img src="static/img/view.png" alt="Afficher le mot de passe">
                </span>
                <br>
                <input type="password" autocomplete="off" id="passwordConfirm" data-id="<?= $user->id; ?>"
                       class="input-form" value="Confirmez votre mot de passe>">
            </div>
            <div class="center">
                <button type="submit" class="submit-button" name="update">Mettre à jour</button>
            </div>
        </form>
        <br>
    </div>
    <div id="mesMessages" class="flex flex-column gap-1 rounded-box mb-2">
        <!-- Messages will be injected here -->
        <h3>Mes messages</h3>
        <p></p>
    </div>

</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
