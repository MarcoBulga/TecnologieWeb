<?php
require_once 'bootstrap.php';

$templateParams["page"] = "./search-page.php";
$templateParams["courses"] = $dbh->getAllCourses();
$templateParams["filters"] = $dbh->getAllFilters();
$templateParams["Gruppi"] = $dbh->searchByFilters(array("online","accessibile","in presenza"),"te");

require './template/base.php';
?>