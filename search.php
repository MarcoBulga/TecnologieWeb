<?php
require_once 'bootstrap.php';

$templateParams["page"] = "./search-page.php";
$templateParams["courses"] = $dbh->getAllCourses();
$templateParams["filters"] = $dbh->getAllFilters();
$templateParams["Gruppi"] = $dbh->searchName("a");

require './template/base.php';
?>