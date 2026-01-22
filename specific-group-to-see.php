<?php
require_once("bootstrap.php");

$templateParams["page"] = "specific-group-main.php";

$templateParams["toSee"] = true;

if(isset($_GET['status']) && $_GET['status'] == 'success_leave') {
    $dbh->checkGroupPartecipants($_GET['idGruppo']);
    header("Location: ./user-groups.php");
    exit();
}

if(isset($_POST['btn-elimina-gruppo'])) {
    $dbh->deleteGroup($_GET['idGruppo']);
    if($_SESSION['admin'] == false) {
        header("Location: ./user-groups.php");
        exit();
    } else {
        header("Location: ./search.php");
        exit();
    }
}

if(isset($_POST["send-btn"])) {
    if($_POST["chat-message"] !== "" && $_POST["chat-message"] !== $dbh->getUserLastMessage($_GET['idGruppo'])) {
        $dbh->newMessageInChat($_SESSION['email'],$_POST["chat-message"],$_GET['idGruppo']);
        unset($_POST["chat-message"]);
    }
}
$templateParams["chat"] = $dbh->getGroupMessages($_GET['idGruppo']);

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION['email']);

$templateParams["css"] = array('common-specific-group');

if($_SESSION['admin'] == false) {
    $templateParams["js"] = "chat.js";
}

require './template/base.php';
?>