<?php
ob_start();
session_start();

date_default_timezone_set("America/Toronto");

try {
    $con = new PDO("mysql:dbname=netflix;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Failed to connect to database " . $e->getMessage());
}




?>