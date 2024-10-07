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


    <?php
    if (isset($userData['username'])) {
        $username = $userData['username'];
        ?>



        <button id="get_user_button">Rafraichir & mettre à jour votre profil</button>

        <!-- Username section -->
        <div class="rounded-box">
            <div class="flex flex-row justify-between">
                <h3>Username: <span id="username-display"><?= $username; ?></span></h3>
                <button onclick="toggleButtonEdit('username')">Modifier</button>
            </div>
            <div id="username-edit" style="display:none;">
                <input type="text" id="username-input" value="<?= $username; ?>">
                <button onclick="saveData('username')">Sauvegarder</button>
            </div>
        </div>
    <?php } ?>

    <script src="static/js/profile.js"></script>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>

<!-- 
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


    <?php
    if (isset($userData['username']) && isset($userData['lastname']) && isset($userData['firstname'])) {
        $username = $userData['username'];
        $lastname = $userData['lastname'];
        $firstname = $userData['firstname'];
        ?>

		<div class="rounded-box">
			<div class="flex flex-row justify-between">
				<h3>Username: <?= $username; ?></h3>
			</div>
		</div>
		<div class="rounded-box">
			<div class="flex flex-row justify-between">
				<h3>Last name: <?= $lastname; ?></h3>
			</div>
		</div>
		<div class="rounded-box">
			<div class="flex flex-row justify-between">
				<h3>First name: <?= $firstname; ?></h3>
			</div>
		</div>
    <?php } ?>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?> -->
