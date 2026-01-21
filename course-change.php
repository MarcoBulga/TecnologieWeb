<?php 
require_once 'bootstrap.php';

$templateParams["page"] = 'course-change-main.php';

$templateParams['courses'] = $dbh->getAllCourses();

$templateParams['tags'] = $dbh->getAllFilters();

$templateParams['notifications'] = $dbh->getAllNotifications($_SESSION["email"]);

$templateParams["css"] = array('course-change');

require './template/base.php';
?>