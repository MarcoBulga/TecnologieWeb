<?php 
require_once 'bootstrap.php';

$templateParams['report'] = 'ovvio';

$templateParams['Segnalazioni'] = $dbh->getAllReports();

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

$templateParams['page'] = 'groups-main.php';

if(isset($_POST["btn-search"]) && isset($_POST['ricerca-mio-gruppo'])) {
    $templateParams['Segnalazioni'] = $dbh->searchReports($_POST['ricerca-mio-gruppo']);
} else if(isset($_POST['btn-reset'])) {
    $templateParams['Segnalazioni'] = $dbh->getAllReports();
}

require './template/base.php';
?>