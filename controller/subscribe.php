<?php

//Test connexion
// $username = "theo";
// $password = "chevallier";
// $passwordVerify = "$2y$10$/ZI9lXq1IgOCPzCGdfRyJ.Y4KPS93DFDqLnwfN8f8ktszwvdMANUm";
// if(password_verify($password, $passwordVerify)){
//     echo "Connexion ok";
// } else {
//     echo "Connexion ko";
// }

/*
    Nans : On peut marquer les champs comme "required"
*/
// Check if all fields are filled
// if (!(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']))) {
//     echo "A field is empty";
//     goto view;
// }

/* Nans : attention, on préfère ne jamais expliquer à l'utilisateur la raison d'une erreur !
    Le risque serait qu'un utilisateur malveillant teste si un email existe chez nous,
    alors que nous souhaitons que les emails de nos clients restent privés
    */
// } else {
// If email is not ok, display an error message
// echo "Your email is not valid";
// goto view;
// }

/**
 * Check if:
 * - email is ok
 * - password length is ok
 * - passwords and passwordConfirm are the same
 */

//echo les données
// echo "Name: " . $name . "<br>";
// echo "Surname: " . $surname . "<br>";
// echo "username: " . $username . "<br>";
// echo "email: " . $email . "<br>";
// echo "Password: " . $password . "<br>";
// echo "PasswordConfirm: " . $passwordConfirm . "<br>";


//Send email to the user to confirm his subscription 
//(je sais pas encore si on envoie un lien de confirmation ou un numéro à entrer sur le site)
// $to = 'theolemayne@gmail.com';
// $subject = 'G4rden - Confirm your email ';
// $message = '<html><body><p>Hello,</p><p>You have successfully subscribed to G4rden.</p><p>Your username is ' . $username . '</p><p>To confirm your subscription, </p></body></html>';
// $headers = 'From: G4rden <noreply@g4rden.com>' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
// if ($email = mail($to, $subject, $message, $headers)) {
//     echo "Email sent";
// }





// Subscribe controller

// Includes required models
require_once("model/User.php");

// Check if a form has been submitted
if (isset($_POST['subscribe'])) {
    $isUserCreated = createUser();
}

function createUser()
{
    // Field list to sanitize
    $formDataList = ['lastname', 'firstname', 'username', 'password', 'passwordConfirm'];

    // Sanitize data and destructure variables
    foreach ($formDataList as $dataName) {
        ${$dataName} = htmlspecialchars($_POST[$dataName], ENT_QUOTES, 'UTF-8');
    }

    // If password is not ok, return null
    if (!(strlen($password) >= 8) && !($password == $passwordConfirm)) {
        error_log("Password is not ok");
        return null;
    }

    // Instantiate the user
    $newUser = new User('', $lastname, $firstname, $username, $password, 'USER');
    $isUserAvailable = $newUser->isUsernameAvailable($username);

    // If the username already exists, return null
    if (!$isUserAvailable) {
        error_log("Username already exists");
        return null;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Creates the user in the database
    $newUser->addUser($hashedPassword);

    // Return the username
    return $newUser->username;
}

// Prepare data for the view


// List of variables to inject in the view
isset($isUserCreated) ? $varToInject = ["username" => $isUserCreated] : $varToInject = [];

// Set page meta data
App::setPageTitle("Subscribe");
App::setPageDescription("Welcome to G4rden");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["utils"]);
// App::loadJsFiles(["subscribe"]);
App::loadViewFile("subscribe", $varToInject);
