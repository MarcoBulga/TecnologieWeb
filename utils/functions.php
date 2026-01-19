<?php

function registerLoggedUser($user) {
    $_SESSION["email"] = $user["email"];
    $_SESSION["name"] = $user["nome"];
    $_SESSION["surname"] = $user["cognome"];
    $_SESSION["admin"] = $user["admin"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['email']);
}

?>