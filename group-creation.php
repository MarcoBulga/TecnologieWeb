<?php 
require_once 'bootstrap.php';

$templateParams["page"] = 'group-creation-main.php';

$templateParams["courses"] = $dbh->getAllCourses();

$templateParams["filters"] = $dbh->getAllFilters();

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

$templateParams["js"] = "tag.js";

require './template/base.php';
?>