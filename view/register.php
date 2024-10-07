<?php
// Message view 
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p class="pb-2">Register by filling the form below.</p>

    <form action="" method="post" class="flex flex-column gap-3 items-center">
        <div class="flex flex-column gap-3 rounded-box w-full">
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="lastname">Lastname</label>
                <input class="input-form" name="lastname" type="text" required>
            </div>
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="firstname">Firstname</label>
                <input class="input-form" name="firstname" type="text" required>
            </div>
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="username">Username</label>
                <input class="input-form" name="username" type="text" required>
            </div>
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="password">Password</label>
                <input class="input-form" name="password" type="password" required>
            </div>
            <div class="flex justify-between gap-2 items-center flex-wrap">
                <label class="bold" for="passwordConfirm">Confirm password</label>
                <input class="input-form" name="passwordConfirm" type="password" required>
            </div>

            <p class="center italic font-sm text-secondary">Already have an account? <a class="font-sm text-secondary" href="index.php?p=login">Login</a></p>
        </div>

        <button type="submit" class="submit-button" name="register">Register</button>
    </form>

</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>