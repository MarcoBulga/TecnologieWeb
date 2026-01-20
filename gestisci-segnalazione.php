<?php
require_once "bootstrap.php";

if($_GET['action'] == 'report') {
    $result['esito'] = $dbh->sendMessage($_SESSION['email'],
                                $_GET['testo'],
                                $_GET['oggetto'],
                                'segnalazione',
                                $dbh->getAdmins());
}

header("Content-Type: application/json");
echo json_encode($result);
?>