<?php 
require_once 'bootstrap.php';

$templateParams["page"] = 'group-creation-main.php';

$templateParams["courses"] = $dbh->getAllCourses();

$templateParams["filters"] = $dbh->getAllFilters();

$templateParams["notifications"] = $dbh->getAllNotifications($_SESSION["email"]);

/* $templateParams["js"] = "tag.js"; */

$templateParams['css'] = array('group-creation');

$valueGroup = false;
if(isset($_POST['confirmbutton']) && empty($_POST['undobutton'])) {
    $selectedFilters = array();
    foreach($templateParams["filters"] as $filter) {
        if(isset($_POST[stringToId($filter["nome"])])) {
            $selectedFilters[] = $filter["nome"];
        }
    }
    $valueGroup = $dbh -> createNewGroup($_POST['groupname'], $_POST['course'], $_POST['groupsize'], 
                    isset($_POST['private']) ? 1 : 0, $_POST['shortdescription'], $_POST['longdescription'],$selectedFilters);
    if($valueGroup) {
        echo "<p>Gruppo creato con successo!</p>";
        $idGruppo = $dbh->getGroupId();
        header("Location: ./specific-group-to-see.php?idGruppo=".$idGruppo);
    } else {
        echo "<p>Errore nella creazione del gruppo.</p>";
    }
}

$templateParams["css"] = array();

require './template/base.php';
?>