<?php
require_once 'bootstrap.php';

$templateParams["title"] = "Login";

$templateParams["js"] = array("login.js");

require './template/login-form.php'; 
?>