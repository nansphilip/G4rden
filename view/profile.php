<?php
// Home view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p class="pb-4">Update your profile informations.</p>

    <div class="flex flex-row gap-2">
        <div class="w-full flex flex-column gap-2">
            <h3>Update your informations</h3>
            <form action="" method="post" class="flex flex-column gap-2">
                <div class="rounded-box flex flex-column gap-2">
                    <div class="flex flex-column">
                        <label for="username" class="bold">Username</label>
                        <input type="text" autocomplete="off" id="username" name="username" class="input-form" placeholder="<?= $username; ?>">
                    </div>
                    <div class="flex flex-column">
                        <label for="firstname" class="bold">Firstname</label>
                        <input type="text" autocomplete="off" id="firstname" name="firstname" class="input-form" placeholder="<?= $firstname; ?>">
                    </div>
                    <div class="flex flex-column">
                        <label for="lastname" class="bold">Lastname</label>
                        <input type="text" autocomplete="off" id="lastname" name="lastname" class="input-form" placeholder="<?= $lastname; ?>">
                    </div>
                    <?php if (isset($notification) && $notification["title"] == "infoUpdated"): ?>
                        <p class="italic bold font-sm"><?= $notification["message"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="center">
                <button type="submit" name="updateInfo" class="submit-button">Mettre à jour</button>
                </div>
            </form>
        </div>

        <div class="w-full flex flex-column gap-2">
            <h3>Update your password</h3>
            <form action="" method="post" class="flex flex-column gap-2 h-full">
                <div class="rounded-box flex flex-column gap-2 h-full">
                    <div class="flex flex-column">
                        <label for="password" class="bold">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="input-form">
                    </div>
                    <div class="flex flex-column">
                        <label for="passwordConfirm" class="bold">Confirm password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" class="input-form">
                    </div>
                </div>
                <div class="center">
                <button type="submit" name="updatePassword" class="submit-button">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>