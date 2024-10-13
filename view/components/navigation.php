<?php
// Navigation links
$commonLinks = "
    <a href={$PATH}/index.php?p=home>Home</a>
    <a href={$PATH}/index.php?p=subject>Subjects</a>
";
$nonLoggedLinks = "
    <a href={$PATH}/index.php?p=register>Register</a>
    <a href={$PATH}/index.php?p=login>Login</a>
";
$loggedLinks = "
    <a href={$PATH}/index.php?p=message>Message</a>
    <a href={$PATH}/index.php?p=logout>Logout</a>
";
?>

<?php
// Desktop navigation bar
?>
<nav class="desktop-nav">
    <?php
    echo $commonLinks;
    // Sets the navigation bar depending if the user is logged in or not
    if (isset($_SESSION['active'])) {
        echo $loggedLinks;
    } else {
        echo $nonLoggedLinks;
    }
    ?>
</nav>

<?php
// Mobile navigation bar
?>
<button class="button-nav" type="button">Menu</button>
<nav class="mobile-nav" style="display: none;">
    <?php
    echo $commonLinks;
    // Sets the navigation bar depending if the user is logged in or not
    if (isset($_SESSION['active'])) {
        echo $loggedLinks;
    } else {
        echo $nonLoggedLinks;
    }
    ?>
</nav>

<script>
    const navBar = document.querySelector(".mobile-nav");
    const buttonNav = document.querySelector(".button-nav");

    // Toggle menu visibility
    buttonNav.addEventListener("click", () => {
        navBar.style.display === "none" ?
            navBar.style.display = "" :
            navBar.style.display = "none";
    });
</script>