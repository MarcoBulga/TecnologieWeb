<?php 
require_once 'bootstrap.php';

$templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email']);

$templateParams["page"] = 'groups-main.php'; 

$templateParams["value"] = 'Entra nel gruppo';

require './template/base.php';
?>