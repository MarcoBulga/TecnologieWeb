<?php
require_once("bootstrap.php");

$result['esito'] = false;

if ($_GET['action'] == 'delete') {
    $result['esito'] = $dbh->deleteNotification($_GET['idNotifica']);
}

header('Content-Type: application/json');
echo json_encode($result);
?>