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

        <div class="flex flex-row flex-wrap gap-2">
            <div class="w-full flex flex-column gap-2">
                <h3>Update your informations</h3>
                <form action="" method="post" class="flex flex-column gap-2 ">
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
                            <div id="toggleEyes">
                                <button type="button" id="closed-eye">
                                    <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-.722-3.25" />
                                        <path d="M2 8a10.645 10.645 0 0 0 20 0" />
                                        <path d="m20 15-1.726-2.05" />
                                        <path d="m4 15 1.726-2.05" />
                                        <path d="m9 18 .722-3.25" />
                                    </svg>
                                </button>
                                <button type="button" id="opened-eye" style="display: none;">
                                    <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-column">
                            <label for="passwordConfirm" class="bold">Confirm password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" class="input-form">
                            <div id="toggleEyes1">
                                <button type="button" id="closed-eye1">
                                    <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-.722-3.25" />
                                        <path d="M2 8a10.645 10.645 0 0 0 20 0" />
                                        <path d="m20 15-1.726-2.05" />
                                        <path d="m4 15 1.726-2.05" />
                                        <path d="m9 18 .722-3.25" />
                                    </svg>
                                </button>
                                <button type="button" id="opened-eye1" style="display: none;">
                                    <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <?php if (isset($notification) && $notification["title"] == "passwordUpdated"): ?>
                            <p class="italic bold font-sm"><?= $notification["message"] ?></p>
                        <?php endif; ?>
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