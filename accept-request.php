<?php
require_once("bootstrap.php");

$result['esito'] = false;

try {
    if ($_GET['action'] == "accept-request") {
        $success = $dbh->addUserToGroup($_GET['email'], $_GET['idGruppo']);
        if ($success) {
            $dbh->sendMessage($_SESSION['email'],
                                "La tua richiesta di entrare nel gruppo è stata accettata!",
                                "Richiesta Accettata",
                                "messaggio",
                                array($_GET['email']));
            $dbh->deleteNotification($_GET['idNotifica']);
        }
        $result['esito'] = $success;
    }
} catch (Exception $e) {
    $result['errore'] = $e -> getMessage();
}

header('Content-Type: application/json');
echo json_encode($result);
?>