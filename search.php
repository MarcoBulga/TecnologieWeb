<?php 
require_once 'bootstrap.php';

$pageNumber = isset($_GET["pageNumber"]) ? $_GET["pageNumber"] : 0;

$templateParams["courses"] = $dbh->getAllCourses();

$templateParams["filters"] = $dbh->getAllFilters();

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

$selectedFilters = isset($_GET["selectedFilters"]) ? $_GET["selectedFilters"] : array();

$ricerca = isset($_GET["ricerca"]) ? $_GET["ricerca"] : false;
$researchString = isset($_GET["researchString"]) ? $_GET["researchString"] : "";
$number = isset($_GET["number"]) ? $_GET["number"] : count($dbh->groupsWithNoUserInSession());
$corso = isset($_GET["corso"]) ? $_GET["corso"] : "";

if(isset($_POST["btn-reset"])) {
    $number = count($dbh->groupsWithNoUserInSession());
    $corso = "";
    $researchString = "";
    $ricerca = false;
    $pageNumber = 0;
}

if(isset($_POST["btn-search"])) {
    $selectedFilters = array();
    $pageNumber = 0;
    $ricerca = true;
    $researchString = isset($_POST["ricerca-mio-gruppo"]) ? $_POST["ricerca-mio-gruppo"] : "";
    $corso = $_POST["course"];
    foreach($templateParams["filters"] as $filter) {
        if(isset($_POST[stringToId($filter["nome"])])) {
            $selectedFilters[] = $filter["nome"];
        }
    }
    if(count($selectedFilters) > 0) {
        $number = count($dbh->searchByFilters($selectedFilters, $researchString, $_SESSION["email"], $corso));
        $templateParams["Gruppi"] = $dbh->searchByFilters($selectedFilters, $researchString, $_SESSION["email"], $corso,$pageNumber*2);
    } else  {
        $number = count($dbh->searchNameAndCourse($researchString, $corso));
        $templateParams["Gruppi"] = $dbh->searchNameAndCourse($researchString, $corso,$pageNumber*2);
    }
} else if($ricerca){
    if(count($selectedFilters) > 0) {
        $templateParams["Gruppi"] = $dbh->searchByFilters($selectedFilters, $researchString, $_SESSION["email"], $corso,$pageNumber*2);
    } else  {
        $templateParams["Gruppi"] = $dbh->searchNameAndCourse($researchString, $corso,$pageNumber*2);
    }
} else {
    $templateParams["Gruppi"] = $dbh->groupsWithNoUserInSession($pageNumber*2);
}

$forward = $number > ($pageNumber+1)*2;

$templateParams["page"] = 'groups-main.php'; 

$templateParams["value"] = 'Entra nel gruppo';

$templateParams["js"] = "tag.js";

require './template/base.php';
?>