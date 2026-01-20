<?php 
require_once 'bootstrap.php';

$pageNumber = isset($_GET["pageNumber"]) ? $_GET["pageNumber"] : 0;
$ricerca = isset($_GET["ricerca"]) ? $_GET["ricerca"] : false;
$researchString = isset($_GET["researchString"]) ? $_GET["researchString"] : "";
$number = isset($_GET["number"]) ? $_GET["number"] : $dbh->getNumberOfUserGroups($_SESSION['email']);

if(isset($_POST["btn-reset"])) {
    $ricerca = false;
    $researchString = "";
    $pageNumber = 0;
    $number = $dbh->getNumberOfUserGroups($_SESSION['email']);
}

if(isset($_POST["btn-search"])) {
    $pageNumber = 0;
    $templateParams["Gruppi"] = $dbh->searchNameWithUser($_POST["ricerca-mio-gruppo"],$pageNumber*2);
    $number = count($dbh->searchNameWithUser($_POST["ricerca-mio-gruppo"]));
    $ricerca = true; 
    $researchString = $_POST["ricerca-mio-gruppo"];
} else if ($ricerca ){
    $templateParams["Gruppi"] = $dbh->searchNameWithUser($researchString,$pageNumber*2);
} else {
    $templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email'], $pageNumber*2);
}

$forward = $number > ($pageNumber+1)*2;

$templateParams["page"] = 'groups-main.php'; 

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

require './template/base.php';
?>