<?php 
require_once 'bootstrap.php';

if(isset($_POST["btn-search"])) {
    $templateParams["Gruppi"] = $dbh->searchNameWithUser($_POST["ricerca-mio-gruppo"]);
} else {
    $templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email']);
}

$templateParams["page"] = 'groups-main.php'; 

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

require './template/base.php';
?>