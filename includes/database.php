<?php

$bdhost = "localhost";
$bduser = "root";
$bdpass = "password";
$bdname = "appsalon";
$dsn = "mysql:host=$bdhost;dbname=$bdname";

try{
     $db = new PDO($dsn, $bduser, $bdpass);
} catch(PDOException $error) {
     echo $error->getMessage();
}