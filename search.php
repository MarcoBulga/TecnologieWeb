<?php 
require_once 'bootstrap.php';


$templateParams["courses"] = $dbh->getAllCourses();

$templateParams["filters"] = $dbh->getAllFilters();

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

$selectedFilters = array();

if(isset($_POST["btn-search"])) {
    foreach($templateParams["filters"] as $filter) {
        if(isset($_POST[$filter["nome"]])) {
            $selectedFilters[] = $filter["nome"];
        }
    }
    if(count($selectedFilters) > 0) {
    $templateParams["Gruppi"] = $dbh->searchByFilters($selectedFilters, isset($_POST["ricerca-mio-gruppo"]) ? $_POST["ricerca-mio-gruppo"] : "", $_SESSION["email"], $_POST["course"]);
    } else  {
        $templateParams["Gruppi"] = $dbh->searchNameAndCourse($_POST["ricerca-mio-gruppo"],$_POST["course"]);
    }
} else {
    $templateParams["Gruppi"] = $dbh->groupsWithNoUserInSession();
}

$templateParams["page"] = 'groups-main.php'; 

$templateParams["value"] = 'Entra nel gruppo';

require './template/base.php';
?>