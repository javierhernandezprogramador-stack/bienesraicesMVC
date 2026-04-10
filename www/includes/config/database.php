<?php

function conecterDB(): mysqli
{ //le decimos que retornara una instancia de mysqli
    $hostName =  getenv('DB_HOST');
    $usuario = getenv('DB_USER');
    $password = getenv('DB_PASS');
    $dbName = getenv('DB_NAME');

    $db = new mysqli($hostName, $usuario, $password, $dbName);

    if (!$db) {
        echo "Error no se conecto a la base de datos";
        exit;
    }

    return $db;
}
