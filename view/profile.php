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
		<div class="rounded-box">
			<form id="profile-edit" class="flex flex-column gap-2">
				<div class="rounded-box" post="">
					<h3 class="pb-1">Username</h3>
					<input type="text" autocomplete=off id="username" data-id="<?= $user->id; ?>" class="input-form" value="<?= $user->username; ?>">
					<h3 class="pb-1 pt-2">Firstname</h3>
					<input type="text" autocomplete=off id="firstname" data-id="<?= $user->id; ?>" class="input-form" value="<?= $user->firstname; ?>">
					<h3 class="pb-1 pt-2">Lastname</h3>
					<input type="text" autocomplete=off id="lastname" data-id="<?= $user->id; ?>" class="input-form" value="<?= $user->lastname; ?>">
				</div>
				<div class="center">
					<button type="submit" class="submit-button">Mettre à jour</button>
				</div>
			</form>
		</div>
	</div>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
