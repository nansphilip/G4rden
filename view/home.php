<?php
// Home view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>

<main>
    <h2><?= App::$pageTitle; ?></h2>
    <p>Welcome to G4rden. Please <a href="index.php?p=register">register</a> or <a href="index.php?p=login">login</a> to chat.</p>
    <h3>Subjects</h3>
    <div>
        <?php foreach ($subjectList as $subject): ?>
            <div data-id="<?= $subject['subjectId']; ?>" class="rounded-box">
                <h4>Nom du sujet : <?= $subject['name']; ?></h4>
                <p>Description : <?= $subject['description']; ?></p>
                <p>Créé par : <?= $subject['subjectCreator']; ?></p>
                <p>Dernier message : <?= $subject['lastMessage']; ?></p>
                <p>Le : <?= $subject['lastMessageDate']; ?></p>
                <p>Par : <?= $subject['lastMessageAuthor']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php
// Includes the footer
require_once("view/components/footer.php");
?>
