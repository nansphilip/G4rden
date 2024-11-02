<?php
// Home view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>
<main class="flex flex-column overflow-y-hidden">
    <h2 class="bold">Accueil</h2>
    <p class="mb-2">Bienvenu sur G4rden, le forum des plantes. Choisissez une de nos dernières discussions plantureuses et ramenez votre graine.</p>
    <?= isset($_SESSION['active']) ? '' : '<p class="mb-2"><a href="index.php?p=register">Inscrivez-vous</a> ou <a href="index.php?p=login">connectez-vous</a> pour commencer à discuter.</p>'; ?>

    <ul id="subjectContainer" class="flex-1 flex flex-column gap-2 pl-0 overflow-y-auto padding-shadow" aria-label="Liste des sujets">
        <?php foreach ($subjectList as $subject): ?>
            <li data-id="<?= $subject['subjectId']; ?>" class="rounded-subject">
                <a href="<?= "{$PATH}/index.php?p=subject&id={$subject['subjectId']}"; ?>" aria-label="Sujet: <?= $subject['name']; ?>">
                    <div class="flex flex-column gap-3">
                        <div class="flex flex-row justify-between flex-wrap">
                            <div>
                                <h3 class="bold text-lg"><?= $subject['name']; ?></h3>
                                <p class="text-sm"><?= $subject['description']; ?></p>
                            </div>
                            <p class="right text-sm">Créé par <span class="bold"><?= $subject['creatorName']; ?></span></p>
                        </div>
                        <div class="flex flex-row justify-between flex-wrap">
                            <div>
                                <h4 class="text-sm"><span class="bold">Dernière activité</span> <span class="text-secondary">le <?= $subject['lastMessageDate']; ?> à <?= $subject['lastMessageTime']; ?> </span></h4>
                                <p class="text-sm italic">"<?= $subject['lastMessage']; ?>"</p>
                            </div>
                            <p class="text-sm">Écrit par <span class="bold"><?= $subject['lastMessageAuthor']; ?></span></p>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php
    // Includes the footer
    require_once("view/components/footer.php");
    ?>