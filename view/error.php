<?php
// Error view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main class="overflow-x-hidden">
    <h2><?= App::$pageTitle; ?></h2>
    <pre class="wrap">
        <?php
        if ($e->getMessage() === "404") {
            print_r("Oh no... This page doesn't exist.");
        } else if ($ENVIRONMENT === 'DEV') {
            print_r("\n");
            print_r("Global error -> " . $e->getMessage());
            print_r("\n");
            print_r("\n");
            print_r("Form file -> " . $e->getFile());
            print_r("\n");
            print_r("At the line -> " . $e->getLine());
        } else {
            print_r("Something went wrong. Please try again later.");
        }
        ?>
    </pre>
</main>
