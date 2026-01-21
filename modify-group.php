<?php
require_once 'bootstrap.php';

$templateParams["modify"] = 'modifica';

$templateParams["page"] = './specific-group-main.php';

$templateParams["toSee"] = false;

$templateParams["old_description"] = $dbh->getGroupLongDescription($_GET['idGruppo']);

if($_SERVER['REQUEST_METHOD'] === 'GET') {   /*serve per svuotare la lista dei rimossi se l'utente è appena entrato in modifica, così da non avere rimossi vecchi che non vogliamo */
    unset($_SESSION['lista-rimossi']);
}

if(isset($_POST['btn-user'])) {
    if(!isset($_SESSION['lista-rimossi'])) {
        $_SESSION['lista-rimossi'] = array();
    }
    $_SESSION['lista-rimossi'][] = $_POST['btn-user'];
    $dbh->deleteUserFromGroup($_POST['btn-user'],$_GET['idGruppo']);
}

if(isset($_POST['btn-confirm'])) {
    $dbh->updateGroupName($_POST['new-name'], $_GET['idGruppo']);
    $dbh->updateGroupLongDescription($_POST['new-long-descr'], $_GET['idGruppo']);
    $dbh->updateGroupShortDescription($_POST['new-short-descr'], $_GET['idGruppo']);
    if($_SESSION['admin'] == true && $dbh->checkGroupPartecipants($_GET['idGruppo']) == 1) {
        header("Location: ./search.php");
    }
    else if ($dbh->checkGroupPartecipants($_GET['idGruppo']) == 1) {
        header("Location: ./user-groups.php");
        exit();
    } else {
        header("Location: ./specific-group-to-see.php?idGruppo=".$_GET['idGruppo']);
        exit();
    }
}

if(isset($_POST['btn-annulla'])) {
    if(isset($_SESSION['lista-rimossi'])) {
        foreach($_SESSION['lista-rimossi'] as $rimosso) {
            $dbh->addUserToGroup($rimosso, $_GET['idGruppo']);
        }
        unset($_SESSION['lista-rimossi']);
    }
    header("Location: ./specific-group-to-see.php?idGruppo=".$_GET['idGruppo']);
    exit();
}

$templateParams['notifications'] = $dbh->getAllNotifications($_SESSION["email"]);

$templateParams['css'] = array('common-specific-group');

require './template/base.php';
?>