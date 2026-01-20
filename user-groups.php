<?php 
require_once 'bootstrap.php';

$pageNumber = isset($_GET["pageNumber"]) ? $_GET["pageNumber"] : 0;

if(isset($_POST["btn-search"])) {
    $templateParams["Gruppi"] = $dbh->searchNameWithUser($_POST["ricerca-mio-gruppo"]);
} else {
    $templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email'], $pageNumber*2);
}

$templateParams["page"] = 'groups-main.php'; 

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

require './template/base.php';
?>