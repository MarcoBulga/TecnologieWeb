<?php
session_start();
define("UPLOAD_DIR", "./upload/");
require_once("DB/database.php");
$dbh = new DatabaseHelper("localhost","root","","tecnologieWeb","3306");
?>