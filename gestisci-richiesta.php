<?php
require_once "bootstrap.php";

$result["esito"] = $dbh->removeUserFromGroup($_SESSION['email'], $_GET['idGruppo']);

header("Content-Type: application/json");
echo json_encode($result);
?>