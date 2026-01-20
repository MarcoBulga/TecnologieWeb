<?php
require_once("bootstrap.php");

$templateParams["page"] = "specific-group-main.php";

$templateParams["toSee"] = false;

$templateParams['notifications'] = $dbh->getAllNotifications($_SESSION["email"]);

require './template/base.php';
?>