<!-- <nav class="nav-bar">
    <a href="/G4rden/index.php?p=home">Home</a>
    <a href="/G4rden/index.php?p=message">Message</a>
    <a href="/G4rden/index.php?p=subscribe">Subscribe</a>
</nav> -->
<?php $env = parse_ini_file(".env");
$PATH = $env['PATH']; ?>

<nav class="nav-bar">
    <a href="<?php echo $PATH ?>/index.php?p=home">Home</a>
    <a href="<?php echo $PATH ?>/index.php?p=message">Message</a>
    <a href="<?php echo $PATH ?>/index.php?p=subscribe">Subscribe</a>
</nav>