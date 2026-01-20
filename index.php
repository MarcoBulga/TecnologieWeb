<?php
require_once 'bootstrap.php';

$templateParams["title"] = "Ricerca Gruppi - Schermata Introduttiva";

if(isset($_SESSION["name"]) && isset($_SESSION["surname"])){
    $templateParams["user"] = $_SESSION["name"] . " " . $_SESSION["surname"];
} else {
    $templateParams["user"] = "Ciao!";
}

$templateParams["content"] = "home-content.php";

require 'index-page.php'; 
?>