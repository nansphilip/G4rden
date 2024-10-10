<?php
// Desktop navigation bar
?>
<nav class="desktop-nav">
    <?= "<a href={$PATH}/index.php?p=home>Home</a>" ?>
    <?php
    // Sets the navigation bar depending if the user is logged in or not
    if (isset($_SESSION['active'])) {
        echo "<a href={$PATH}/index.php?p=message>Message</a>";
        echo "<a href={$PATH}/index.php?p=logout>Logout</a>";
        if($_SESSION['userType'] == 'ADMIN'){
            echo "<a href={$PATH}/index.php?p=admin-interface>Admin interface</a>";
        }
    } else {
        echo "<a href={$PATH}/index.php?p=login>Login</a>";
        echo "<a href={$PATH}/index.php?p=register>Register</a>";
    }
    ?>
</nav>

<?php
// Mobile navigation bar
?>
<button class="button-nav" type="button">Menu</button>
<nav class="mobile-nav" style="display: none;">
    <?= "<a href={$PATH}/index.php?p=home>Home</a>" ?>
    <?php
    // Sets the navigation bar depending if the user is logged in or not
    if (isset($_SESSION['active'])) {
        echo "<a href={$PATH}/index.php?p=message>Message</a>";
        echo "<a href={$PATH}/index.php?p=logout>Logout</a>";
    } else {
        echo "<a href={$PATH}/index.php?p=login>Login</a>";
        echo "<a href={$PATH}/index.php?p=register>Register</a>";
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