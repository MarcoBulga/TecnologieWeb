<?php
require_once 'bootstrap.php';

$result["logineseguito"] = false;
$result['admin'] = isset($_SESSION["admin"]) ? $_SESSION["admin"] == 0 ? false : true : false;
if(!empty($_POST["email"]) && !empty($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $result["errorelogin"] = "Email e/o password errati";
    }
    else{
        registerLoggedUser($login_result[0]);
        $result['admin'] = $_SESSION['admin'] == 0 ? false : true;
    }
} else {
    $result["errorelogin"] = "Inserire E-mail e/o password";
}

if(isUserLoggedIn()) {
    $result["logineseguito"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>