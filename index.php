<?php
require_once 'bootstrap.php';

if(isset($_SESSION["name"]) && isset($_SESSION["surname"])){
    $templateParams["user"] = $_SESSION["name"] . " " . $_SESSION["surname"];
} else {
    $templateParams["user"] = "Ciao!";
}

require 'home-content.php';
?>