<?php
// Message view 
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p class="pb-2">Enter your username and your password to login. <a href="index.php?p=home">Click here to go back home.</a></p>

    <form action="" method="post" class="flex flex-column gap-2">
        <div class="flex justify-between">
            <label for="username">Pseudo: </label>
            <input name="username" type="text" required>
        </div>

        <div class="flex justify-between">
            <label for="password">Mot de passe: </label>
            <input name="password" type="password" required>
        </div>

        <button type="submit" name="login">Se connecter</button>
    </form>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>