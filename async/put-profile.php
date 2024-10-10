<?php
// Profile update script
require_once "./model/User.php";

try {
    // Get JSON post data
    $input = file_get_contents('php://input');

    $data = json_decode($input, true);


    if (is_null($data)) {
        throw new Error("No data provided");
    }

    // Parameters list
    $paramList = ["username", "firstname", 'lastname'];

    // Sanitize data
    foreach ($paramList as $param) {
        if (!isset($data[$param])) throw new Error("A parameter is missing");
        $data[$param] = htmlspecialchars($data[$param], ENT_QUOTES, 'UTF-8');
    }

    // Update the user
    
    // A toi de jouer, il nous faut instancier un objet User
    // ok, avec les anciennes infos yes 
    // On veut savoir ce qu'on a en base
    // Donc on crée un objet avec les old infos pour vérif le changement: oui
    // ok push le doc et je reprend la suite je work j'ai du time
// Get id from session
    $id = $_SESSION['id'];

// Create a new user object from the id
    $user = new User();
    $user->getUserById($id);

    $user->update($data["username"]);

    // Encode the data
    echo json_encode([
        "status" => "ok",
        "message" => "Data fetched with success",
        "data" => null
    ]);
} catch (Throwable $e) {

    // Show the error message in the console
    throw new Error("Profile update -> " . $e->getMessage());

    // Return an error to the client
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage(),
        "data" => null
    ]);
}
