<?php
require_once "bootstrap.php";

if ($_GET['action'] == 'leave') {
    $result["esito"] = $dbh->removeUserFromGroup($_SESSION['email'], $_GET['idGruppo']);
} else if ($_GET['action'] == 'join') {
    $result["esito"] = $dbh->addUserToGroup($_SESSION['email'], $_GET['idGruppo']);
}

header("Content-Type: application/json");
echo json_encode($result);
?>