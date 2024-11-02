<?php
// Message view 
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main class="flex flex-column overflow-y-hidden">
    <h2 class="bold">S'inscrire</h2>
    <p class="mb-2">Inscrivez-vous en remplissant le formulaire ci-dessous.</p>

    <form action="" id="registerForm" method="post" class="flex flex-column gap-3 padding-shadow overflow-y-auto">
        <div class="flex flex-column gap-2 rounded-box pt-1 pb-2">
            <div class="flex flex-column gap-1">
                <label class="bold" for="lastname">Nom</label>
                <input class="input-form" name="lastname" id="lastname" type="text" required autofocus aria-label="Nom">
            </div>
            <div class="flex flex-column gap-1">
                <label class="bold" for="firstname">Prénom</label>
                <input class="input-form" name="firstname" id="firstname" type="text" required aria-label="Prénom">
            </div>
            <div class="flex flex-column gap-1">
                <label class="bold" for="username">Pseudo</label>
                <input class="input-form" name="username" id="username" type="text" required aria-label="Pseudo">
            </div>
            <div class="flex flex-column gap-1">
                <label class="bold" for="password">Mot de passe</label>
                <input class="input-form" name="password" id="password" type="password" required aria-label="Mot de passe">
            </div>
            <div class="flex flex-column gap-1">
                <label class="bold" for="passwordConfirm">Confirmer le mot de passe</label>
                <input class="input-form" name="passwordConfirm" id="passwordConfirm" type="password" required aria-label="Confirmer le mot de passe">
            </div>
            <?php if (isset($notification)): ?>
                <div class="flex flex-row justify-center pt-1">
                    <p class="italic bold font-sm center text-alert"><?= $notification ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex flex-column items-center gap-2">
            <p class="italic text-sm text-secondary">Vous êtes déjà inscrit ? <a class="text-sm text-secondary" href="index.php?p=login">Se connecter</a></p>
            <button type="submit" class="submit-button" name="register" aria-label="S'inscrire">S'inscrire</button>
        </div>
        </div>
    </form>

    <div class="flex-1"></div>

    <?php
    // Includes the footer
    require_once("view/components/footer.php");
    ?>