<?php 
require_once 'bootstrap.php';

$templateParams["page"] = 'group-creation-main.php';

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

require './template/base.php';
?>