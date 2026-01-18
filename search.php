<?php
require_once 'bootstrap.php';

$templateParams["page"] = "./search-page.php";
$templateParams["courses"] = $dbh->getAllCourses();
$templateParams["filters"] = $dbh->getAllFilters();
$templateParams["Gruppi"] = array();

require './template/base.php';
?>