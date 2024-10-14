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

        <form id="profile-edit" class="flex flex-column gap-2" action="index.php?p=profile" method="post">
            <div class="rounded-box">
                <label for="username" class="pb-1">Username</label>
                <br>
                <input type="text" autocomplete="off" id="username" name="username" class="input-form"
                       value="<?= $user->username; ?>">
                <br>
                <label for="firstname" class="pb-1 pt-2">Firstname</label>
                <br>
                <input type="text" autocomplete="off" id="firstname" name="firstname" class="input-form"
                       value="<?= $user->firstname; ?>">
                <br>
                <label for="lastname" class="pb-1 pt-2">Lastname</label>
                <br>
                <input type="text" autocomplete="off" id="lastname" name="lastname" class="input-form"
                       value="<?= $user->lastname; ?>">
                <br>
                <label for="password" class="pb-1 pt-2">Password</label>
                <span id="view" class="view-pw">
                        <img src="static/img/view.png" alt="Afficher le mot de passe">
                </span>
                <br>
                <input type="password" autocomplete="off" id="password" name="password" class="input-form"
                       placeholder="Entrez votre mot de passe">
                <br>
                <label for="passwordConfirm" class="pb-1 pt-2">Confirm Password</label>
                <span id="hide" class="view-pw">
                        <img src="static/img/view.png" alt="Afficher le mot de passe">
                </span>
                <br>
                <input type="password" autocomplete="off" id="passwordConfirm" name="passwordConfirm"
                       class="input-form" class="input-form" placeholder="Confirmez votre mot de passe">
            </div>
            </div>
            <div class="center">
                <input type="submit" class="submit-button" value="Mettre à jour"/>
            </div>
        </form>
        <br>
    </div>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
