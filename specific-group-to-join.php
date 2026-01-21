<?php
require_once("bootstrap.php");

$templateParams["page"] = "specific-group-main.php";

$templateParams["toSee"] = false;

$templateParams['notifications'] = $dbh->getAllNotifications($_SESSION["email"]);

$templateParams['css'] = array('common-specific-group');

require './template/base.php';
?>