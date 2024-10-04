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
?>
