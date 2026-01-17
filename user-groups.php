<?php 
require_once 'bootstrap.php';

$templateParams["Gruppi"] = $dbh->getGroups($_SESSION['email']);

require './template/base.php';
?>