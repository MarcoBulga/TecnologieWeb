<?php
require_once 'bootstrap.php';

$templateParams["Utenti"] = $dbh->getUsers();

require 'page.php';
?>