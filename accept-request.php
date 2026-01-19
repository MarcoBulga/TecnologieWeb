<?php
require_once("bootstrap.php");

$result['esito'] = false;

if ($_GET['action'] = "accept-request") {
    $success = $dbh->addUserToGroup($_GET['email'], $_GET['idGruppo']);
    if ($success) {
        $dbh->sendMessage($_SESSION['email'],
                            "La tua richiesta di entrare nel gruppo è stata accettata!",
                            "Richiesta Accettata",
                            "messaggio",
                            $_GET['email']);
    }
    $result['esito'] = $success;
}

echo json_encode($result);
?>