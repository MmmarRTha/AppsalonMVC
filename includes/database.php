<?php

$db = mysqli_connect('localhost', 'root', 'password', 'appsalon');

if(!$db)
{
     echo "Error: no se pudo conectar";
     echo "errno de depuracion" . mysqli_connect_errno();
     echo "error de depuracion" . mysqli_connect_error();
     exit;
}

// $bdhost = "localhost";
// $bduser = "root";
// $bdpass = "password";
// $bdname = "appsalon";
// $dsn = "mysql:host=$bdhost;dbname=$bdname";

// try{
//      $db = new PDO($dsn, $bduser, $bdpass);
// } catch(PDOException $error) {
//      echo $error->getMessage();
// }