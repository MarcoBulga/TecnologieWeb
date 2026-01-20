<?php
require_once "bootstrap.php";

try {
    if($_GET['action'] == 'add_course') {
        $result['esito'] = $dbh->addCourse($_GET['nomeCorso']);
    } else if ($_GET['action'] == 'remove_course') {
        $result['esito'] = $dbh->deleteCourse($_GET['nomeCorso']);
    }
} catch (Exception $e) {
    $result['esito'] = false;
}

header("Content-Type: application/json");
echo json_encode($result);
?>