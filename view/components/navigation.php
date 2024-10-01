<?php $env = parse_ini_file(".env");
$PATH = $env['PATH']; ?>

<nav class="nav-bar">
    <?php 
    //Sets the navigation bar depending if the user is logged in or not
    if(!isset($_SESSION['userId'])){
        echo '<a href="' . $PATH .'/index.php?p=sign_in">Sign In</a>'; 
        echo '<a href="' . $PATH .'/index.php?p=subscribe">Subscribe</a>';
    }
    else { 
        echo '<a href="' .$PATH .'/index.php?p=home">Home</a>';
        echo '<a href="' .$PATH .'/index.php?p=message">Message</a>';
        echo '<a href="' .$PATH .'/index.php?p=logout">Logout</a>';
    }?>
</nav>