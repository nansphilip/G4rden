<?php
// Sign in controller

if(isset($_POST['signIn'])){
    //Check if all fields are filled
    if (!(isset($_POST['username']) && isset($_POST['password']))) {
        echo "A field is empty";
        goto view;
    } else {
        $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
        //Check if the username is a mail
        require_once("model/User.php");
        $admin = new Admin('1', 'Admin', 'Admin', 'admin', 'admin', 'ADMIN', 'admin@g4rden.com');
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //The username is his mail
            $userPwd = $admin->getUserPasswordByMail($username);
            $userId = $admin->getUserIdByMail($username);
            $user = $admin->getUserById($userId);
            //Check if the password is correct
            if (password_verify($password, $userPwd)) {
                goto redirection;
            } else {
                echo "Les informations de connexion sont incorrectes";
                goto view;
            }
        } else {
            //The username is his username
            $userPwd = $admin->getUserPasswordByUsername($username);
            $userId = $admin->getUserIdByUsername($username);
            $user = $admin->getUserById($userId);
            $admin->deleteUserByUsername('Admin');
            //Check if the password is correct
            if (password_verify($password, $userPwd)) {
                goto redirection;
            } else {
                echo "Les informations de connexion sont incorrectes";
                goto view;
            }
        }
    }
    //If all informations are correct and password verified, redirect to the home page with $_SESSION variables
    redirection:
    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $userId;
    $_SESSION['userName'] = $user['username'];
    $_SESSION['userMail'] = $user['mail'];
    $_SESSION['userSurname'] = $user['surname'];
    $_SESSION['userType'] = $user['user_type'];
    header("Location: index.php?p=home");
}
    


view:
// List of variables to inject in the view
$varToInject = [];

// Set page meta data
App::setPageTitle("Sign In");
App::setPageDescription("G4rden chat");
App::setPageFavicon("world.png");

// Load the view
App::loadCssFiles(["message", "utils"]);
App::loadJsFiles(["message"]);
App::loadViewFile("sign_in", $varToInject);
