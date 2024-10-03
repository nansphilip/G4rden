<?php // Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>

<script type="module">
    import { getLastUser } from "/static/js/last-user.js";

    const buttonEl = document.querySelector("#last_user_button");
    buttonEl.addEventListener("click", async () => {
        const lastUser = await getLastUser();
        console.log(lastUser);
    });
</script>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <button id="last_user_button">Get last user</button>
</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>