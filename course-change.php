<?php 
require_once 'bootstrap.php';

$templateParams["page"] = 'course-change-main.php';

$templateParams['courses'] = $dbh->getAllCourses();

require './template/base.php';
?>