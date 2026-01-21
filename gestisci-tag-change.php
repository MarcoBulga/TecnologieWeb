<?php
require_once "bootstrap.php";

try {
    if($_GET['action'] == 'add_tag') {
        $result['esito'] = $dbh->addTag($_GET['nomeTag']);
    } else if ($_GET['action'] == 'remove_tag') {
        $result['esito'] = $dbh->removeTag($_GET['nomeTag']);
    }
} catch (Exception $e) {
    $result['esito'] = false;
}

header("Content-Type: application/json");
echo json_encode($result);
?>