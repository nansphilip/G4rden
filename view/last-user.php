<?php // Message view 
?>

<?php
// Includes the header
require_once "view/components/header.php";
?>

<script type="module">
    import { getLastUser } from "/static/js/last-user.js";

    const getLastUserButton = document.querySelector("#getLastUserButton");
    getLastUserButton.addEventListener("click", async () => {
        const lastUser = await getLastUser();
        console.log(lastUser);
    });
</script>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Your are consulting G4rden's chat. <a href="index.php?p=home">Click here to go back home.</a></p>

    <pre>
        <?php
        // print_r($lastUser);
        ?>
    </pre>

    <button id="getLastUserButton">Get last user</button>

</main>

<?php
// Includes the footer
require_once "view/components/footer.php";
?>