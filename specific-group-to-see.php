<?php
require_once("bootstrap.php");

$templateParams["page"] = "specific-group-main.php";

$templateParams["toSee"] = true;

if(isset($_GET['status']) && $_GET['status'] == 'success_leave') {
    $dbh->checkGroupPartecipants($_GET['idGruppo']);
    header("Location: ./user-groups.php");
    exit();
}

require './template/base.php';
?>