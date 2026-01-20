<?php 
require_once 'bootstrap.php';

$templateParams['report'] = 'ovvio';

$templateParams['Segnalazioni'] = $dbh->getAllReports();

$templateParams['page'] = 'groups-main.php';

require './template/base.php';
?>