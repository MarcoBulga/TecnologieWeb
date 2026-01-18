<?php

session_unset();  /*svuota l'array globale $_SESSION  */
session_destroy();  /*elimina il file fisico della sessione sul server*/

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

header("Location: index.php");
exit();
?>