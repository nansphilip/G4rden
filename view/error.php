<?php
// Error view
?>

<main class="flex flex-column gap-2 justify-center">
    <h2>Error</h2>
    <pre>
        <?php
        if ($e->getMessage() === "404") print_r("Oh no... This page doesn't exist.");
        else if ($ENVIRONMENT === 'DEV') print_r($e->getMessage());
        else print_r("Something went wrong. Please try again later.");
        ?>
    </pre>
</main>