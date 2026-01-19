<?php 
require_once 'bootstrap.php';


$templateParams["courses"] = $dbh->getAllCourses();

$templateParams["filters"] = $dbh->getAllFilters();

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



/* if(isset($templateParams["value"]) && isset($_POST["ricerca-mio-gruppo"]) && isset($_POST["btn-search"])) {
        $templateParams["Gruppi"] = $dbh->searchName($_POST["ricerca-mio-gruppo"]);
        unset($_POST["btn-reset"]);
        unset($_POST["ricerca-mio-gruppo"]);
    } else if(isset($templateParams["value"]) && isset($_POST["btn-reset"])) {
        $templateParams["Gruppi"] = $dbh->groupsWithNoUserInSession();
        unset($_POST["btn-reset"]);
        unset($_POST["ricerca-mio-gruppo"]);
    } else if(isset($_POST["ricerca-mio-gruppo"])) {
        $templateParams["Gruppi"] = $dbh->searchNameWithUser($_POST["ricerca-mio-gruppo"]);
        unset($_POST["btn-reset"]);
        unset($_POST["ricerca-mio-gruppo"]);
    } else if(isset($_POST["btn-reset"])) {
        $templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email']);
        unset($_POST["btn-reset"]);
        unset($_POST["ricerca-mio-gruppo"]);
    } */
?>