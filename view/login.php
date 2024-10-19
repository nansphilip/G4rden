<?php
// Message view 
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2 class="bold"><?= App::$pageTitle; ?></h2>
    <p class="pb-2">Enter your username and your password to login.</p>

    <form action="" method="post" class="flex flex-column gap-3 items-center py-2">
        <div class="rounded-box flex flex-column gap-3 w-full">
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="username">Username</label>
                <input class="input-form" name="username" type="text" required>
            </div>
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="password">Password</label>
                <input class="input-form" name="password" type="password" required>
            </div>
            <p class="center italic text-sm text-secondary">Not registered yet? <a class="text-sm text-secondary" href="index.php?p=register">Register</a></p>
        </div>

        <button type="submit" class="submit-button" name="login">Login</button>
    </form>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
