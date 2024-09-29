<?php
// Reply controller

// Includes required models
require_once ("models/Users.php");
require_once ("models/Message.php");

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = null;
}


if (isset($_POST['reply'])) {
    $reply = htmlspecialchars($_POST['reply'], ENT_QUOTES, 'UTF-8');
    $date = date('Y-m-d H:i:s');

    if ($user_id) {
        $newMessage = new Message();

        if ($newMessage->addMessage($reply, $date, $user_id)) {
            echo "Message envoyé avec succès !";
        } else {
            echo "Erreur lors de l'envoi du message.";
        }
    } else {
        echo "Vous devez être connecté pour envoyer un message.";
    }
} else {
    echo "Écrivez un message, NOOB !";
}

?>