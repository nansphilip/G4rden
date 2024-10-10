<?php
// Vérification si le paramètre est passé
if (isset($_POST['param'])) {
    $param = $_POST['param'];

    $result = deleteUser($param);

    // Retour de la réponse en JSON
    echo json_encode([
        'success' => true,
        'message' => $result
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Aucun paramètre reçu.'
    ]);
}
function deleteUser($username)
{
    return "test entree fonction delete, user: " . $username;
}
?>