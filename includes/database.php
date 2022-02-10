<?php

$db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_BD']);

if(!$db)
{
     echo "Error: no se pudo conectar";
     echo "errno de depuracion" . mysqli_connect_errno();
     echo "error de depuracion" . mysqli_connect_error();
     exit;
}
// else
// {
//      echo "Conectado";
// }
