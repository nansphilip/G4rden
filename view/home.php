<?php
// Home view
?>

<?php
// Includes the header
require_once("view/components/header.php");
?>
<main class="overflow-y-auto">

    <h2 class="bold"><?= App::$pageTitle; ?></h2>
    <p class="pb-2">Welcome to G4rden. <?= isset($_SESSION['active']) ? '' : '<a href="index.php?p=register">Register</a> or <a href="index.php?p=login">login</a> to chat.'; ?></p>
    <h3 class="bold text-lg pb-1">Subjects</h3>
    <ul class="flex flex-column gap-2 p-0 padding-shadow">
        <?php foreach ($subjectList as $subject): ?>
            <li data-id="<?= $subject['subjectId']; ?>" class="rounded-subject">
                <a href="<?= "{$PATH}/index.php?p=subject&subject={$subject['subjectId']}"; ?>">
                    <div class="flex flex-column gap-3">
                        <div class="flex flex-row justify-between flex-wrap">
                            <div>
                                <h4 class="bold text-lg"><?= $subject['name']; ?></h4>
                                <p class="text-sm"><?= $subject['description']; ?></p>
                            </div>
                            <p class="right text-sm">Créé par <span class="bold"><?= $subject['creatorName']; ?></span></p>
                        </div>
                        <div class="flex flex-row justify-between flex-wrap">
                            <div>
                                <h5 class="text-sm"><span class="bold">Dernière activité</span> <span class="text-secondary">le <?= $subject['lastMessageDate']; ?> à <?= $subject['lastMessageTime']; ?> </span></h5>
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