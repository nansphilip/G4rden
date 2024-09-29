<?php
session_start(); // Assurez-vous que les sessions sont démarrées

// Vérifiez si l'utilisateur est authentifié
$isAuthenticated = isset($_SESSION['user_id']);

?>

<?php if ($isAuthenticated): ?>
    <form method="post" action="">
        <p>
            <label for="reply">Répondre</label>
            <textarea name="reply" rows="3" cols="100" placeholder="Poste ta merde ici"></textarea>
        </p>

        <p>
            <button type="submit" name="reply">Twerker</button>
        </p>
    </form>
<?php else: ?>
    <p>Vous devez être connecté pour répondre.</p>
<?php endif; ?>
