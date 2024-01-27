<?php require_once 'init.php' ?>
<?php

function loginUser($firstName, $email)
{

    $_SESSION['firstName'] = $firstName;
    $_SESSION['email'] = $email;

    return true;

}


function logoutUser()
{

    if (! checkIfUserIsLoggedIn())
    {
        return false;
    }

    unset($_SESSION['firstName']);
    unset($_SESSION['email']);
    // Destroy the session
    session_destroy();
    return true;
}

function checkIfUserIsLoggedIn()
{
    return isset($_SESSION['firstName']) && isset($_SESSION['email']);
}

function redirect($url) {
    header("Location: $url");
}