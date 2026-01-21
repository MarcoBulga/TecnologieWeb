<?php
require_once 'bootstrap.php';

$result["name"] = $_SESSION['name'];
$result["surname"] = $_SESSION['surname'];
$result["esito"] = true;

$dbh->newMessageInChat($_SESSION['email'],$_GET["text"],$_GET['id']);

header("Content-Type: apllication/json");
echo json_encode($result);
?>