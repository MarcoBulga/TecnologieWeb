<?php
require_once("bootstrap.php");

$templateParams['page'] = 'specific-report-main.php';

$templateParams['css'] = array('common-specific-group');

$templateParams['notifications'] = $dbh->getAllNotifications($_SESSION['email']);

require './template/base.php';
?>