<?php 
require_once 'bootstrap.php';

$templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email']);

$templateParams["page"] = 'groups-main.php';

require './template/base.php';
?>