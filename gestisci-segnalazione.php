<?php
require_once "bootstrap.php";

if($_GET['action'] == 'report') {
    $result['esito'] = $dbh->sendMessage($_SESSION['email'],
                                $_GET['testo'],
                                $_GET['oggetto'],
                                'segnalazione',
                                $dbh->getAdmins());
}

if($_GET['action'] == 'delete') {
    $result['esito'] = $dbh->deleteNotification($_GET['idNotifica']);
}

header("Content-Type: application/json");
echo json_encode($result);
?>