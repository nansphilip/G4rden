<?php

require_once "../model/Message.php";

// Pour les tests, user_id en dur
$user_id = 5;


if (isset($_POST['submit_reply'])) {
 echo "Le formulaire est soumis.<br>";
    $reply = trim(htmlspecialchars($_POST['reply_content'], ENT_QUOTES, 'UTF-8'));
     echo "Le contenu du message est : " . $reply . "<br>";
    $date = date('Y-m-d H:i:s');
    echo "Date : " . $date . "<br>";
    echo "User ID : " . $user_id . "<br>";



        $newMessage = new Message(null, $reply, $date, $user_id);

        if ($newMessage->addMessage()) {
                echo "Message envoyé avec succès !";
            } else {
                echo "Erreur lors de l'envoi du message.";
            }
}

?>