<?php 
require_once 'bootstrap.php';

$templateParams["page"] = 'course-change-main.php';

$templateParams['courses'] = $dbh->getAllCourses();

$templateParams['notifications'] = $dbh->getAllNotifications($_SESSION["email"]);

require './template/base.php';
?>