<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("DB/database.php");
require_once("utils/functions.php");
$dbh = new DatabaseHelper("localhost","root","","tecnologieWeb","3306");
?>