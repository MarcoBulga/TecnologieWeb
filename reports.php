<?php 
require_once 'bootstrap.php';

$pageNumber = isset($_GET["pageNumber"]) ? $_GET["pageNumber"] : 0;
$ricerca = isset($_GET["ricerca"]) ? $_GET["ricerca"] : false;
$researchString = isset($_GET["researchString"]) ? $_GET["researchString"] : "";
$number = isset($_GET["number"]) ? $_GET["number"] : count($dbh->getAllReports());

$templateParams['report'] = 'ovvio';

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

$templateParams['page'] = 'groups-main.php';

if(isset($_POST['btn-reset'])) {
    $pageNumber = 0;
    $ricerca = false;
    $researchString =  "";
    $number =  count($dbh->getAllReports());
}

if(isset($_POST["btn-search"]) && isset($_POST['ricerca-mio-gruppo'])) {
    $ricerca = true;
    $researchString = $_POST['ricerca-mio-gruppo'];
    $pageNumber = 0;
    $number = count($dbh->searchReports($researchString));
    $templateParams['Segnalazioni'] = $dbh->searchReports($researchString,$pageNumber*2);
} else if($ricerca) {
    $templateParams['Segnalazioni'] = $dbh->searchReports($researchString,$pageNumber*2);
} else {
    $templateParams['Segnalazioni'] = $dbh->getAllReports($pageNumber*2);
}

$forward = $number > ($pageNumber+1)*2;

$templateParams["css"] = array("common-search-userGroups");

require './template/base.php';
?>