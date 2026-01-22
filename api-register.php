<?php
require_once 'bootstrap.php';

$result["registersuccess"] = false;
if(!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["surname"])){
    $register_result = $dbh->doesUserExist($_POST["email"]);
    if(count($register_result)==0){
        //registration success
        if($dbh->insertNewUser($_POST["name"],$_POST["surname"],$_POST["email"],$_POST["password"]) == 0) {
            //insert success
            $result["registererror"] = "Errore nell'inserimento del nuovo utente";
        } else {
            //insert failure
            $register_result = $dbh->doesUserExist($_POST["email"]);
            registerLoggedUser($register_result[0]);
        }
    }
    else{
        //registration failed
        $result["registererror"] = "Utente già esistente";
    }
} else {
    $result['registererror'] = "Inserisci tutti i campi!";
}

if(isUserLoggedIn()) {
    $result["registersuccess"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>