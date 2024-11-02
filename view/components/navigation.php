<?php
// Navigation links
$commonLinks = "
    <a href={$PATH}/index.php?p=home aria-label='Accueil'>Accueil</a>
";
$nonLoggedLinks = "
    <a href={$PATH}/index.php?p=register aria-label='Inscription'>Inscription</a>
    <a href={$PATH}/index.php?p=login aria-label='Connexion'>Connexion</a>
";
$loggedLinks = "
    <a href={$PATH}/index.php?p=message aria-label='Message'>Message</a>
    <a href={$PATH}/index.php?p=profile aria-label='Profil'>Profil</a>
";
$adminLinks = "
    <a href={$PATH}/index.php?p=admin-interface aria-label='Admin'>Admin</a>
";
$logoutLink = "
    <a href={$PATH}/index.php?p=logout aria-label='Déconnexion'>Déconnexion</a>
";
?>

<?php
// Desktop navigation bar
?>
<nav class="desktop-nav padding-shadow" aria-label="Desktop Navigation">
    <?php
    echo $commonLinks;
    // Sets the navigation bar depending if the user is logged in or not
    if (isset($_SESSION['active'])) {
        echo $loggedLinks;
        if ($_SESSION['userType'] === 'ADMIN') {
            echo $adminLinks;
        }
        echo $logoutLink;
    } else {
        echo $nonLoggedLinks;
    }
    ?>
    <button type="button" class="icon-nav toggle-theme" aria-label="Toggle Theme Color">
        <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
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
        <svg class="icon" style="display: none;" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
        </svg>
    </button>
</nav>

<?php
// Mobile navigation bar
?>
<button class="button-nav" type="button" aria-label="Toggle Mobile Menu">Menu</button>
<nav class="mobile-nav" style="display: none;" aria-label="Mobile Navigation">
    <?php
    echo $commonLinks;
    // Sets the navigation bar depending if the user is logged in or not
    if (isset($_SESSION['active'])) {
        echo $loggedLinks;
        if ($_SESSION['userType'] === 'ADMIN') {
            echo $adminLinks;
        }
        echo $logoutLink;
    } else {
        echo $nonLoggedLinks;
    }
    ?>
    <button type="button" class="icon-nav toggle-theme" aria-label="Toggle Theme Color">
        <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
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
        <svg class="icon" style="display: none;" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z" />
        </svg>
    </button>
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