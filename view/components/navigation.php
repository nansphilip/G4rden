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
    ";
$logoutLink = "
    <a href={$PATH}/index.php?p=logout>Logout</a>    
";
$adminLinks = "
    <a href={$PATH}/index.php?p=admin-interface>Admin</a>
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
        if ($_SESSION['userType'] == 'ADMIN') {
            echo $adminLinks;
        }
        echo $logoutLink;
    } else {
        echo $nonLoggedLinks;
    }
    ?>
    <button class="icon-nav" id="toggleTheme">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun">
            <circle cx="12" cy="12" r="4" />
            <path d="M12 2v2" />
            <path d="M12 20v2" />
            <path d="m4.93 4.93 1.41 1.41" />
            <path d="m17.66 17.66 1.41 1.41" />
            <path d="M2 12h2" />
            <path d="M20 12h2" />
            <path d="m6.34 17.66-1.41 1.41" />
            <path d="m19.07 4.93-1.41 1.41" />
        </svg>
        <svg style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
        </svg>
    </button>
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
        if ($_SESSION['userType'] == 'ADMIN') {
            echo $adminLinks;
        }
        echo $logoutLink;
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