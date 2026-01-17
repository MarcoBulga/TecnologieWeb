<?php

function registerLoggedUser($user) {
    $_SESSION["email"] = $user["email"];
    $_SESSION["name"] = $user["nome"];
    $_SESSION["surname"] = $user["cognome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

?>