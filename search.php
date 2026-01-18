<?php
require_once 'bootstrap.php';

$templateParams["page"] = "./search-page.php";
$templateParams["filters"] = $dbh->getAllFilters();
$templateParams["Gruppi"] = array();

require './template/base.php';
?>