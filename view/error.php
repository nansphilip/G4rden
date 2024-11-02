<?php
// Error view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main class="overflow-x-hidden">
    <h2 class="bold">Erreur</h2>
    <?php
    if ($e->getMessage() === "404") {
        echo "<p role='alert'>Oh non... Cette page n'existe pas.</p>";
    } else if ($ENVIRONMENT === 'DEV') {
        echo "<p class='wrap' role='alert'>Global error -> {$e->getMessage()}</p>
              <br/>
              <p>Form file -> {$e->getFile()}</p>
              <p>At the line -> {$e->getLine()}</p>";
    } else {
        echo "<p role='alert'>Quelque chose d'inattendu s'est produit. Veuillez réessayer plus tard.</p>";
    }
    ?>
</main>