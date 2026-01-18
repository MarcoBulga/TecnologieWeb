<?php 
require_once 'bootstrap.php';

$templateParams["Gruppi"] = $dbh->groupsWithNoUserInSession();

$templateParams["courses"] = $dbh->getAllCourses();

$templateParams["filters"] = $dbh->getAllFilters();

$templateParams["page"] = 'groups-main.php'; 

$templateParams["value"] = 'Entra nel gruppo';

require './template/base.php';
?>