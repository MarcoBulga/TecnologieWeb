<?php
require_once 'bootstrap.php';

$result["logineseguito"] = false;
$result['admin'] = false;
if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $result["errorelogin"] = "Email e/o password errati";
    }
    else{
        registerLoggedUser($login_result[0]);
        $result['admin'] = $_SESSION['admin'];
    }
}

if(isUserLoggedIn()) {
    $result["logineseguito"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>