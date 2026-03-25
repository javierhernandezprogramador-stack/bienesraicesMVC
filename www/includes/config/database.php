<?php

function conecterDB(): mysqli
{ //le decimos que retornara una instancia de mysqli
    $hostName =  'bienesraices_mvc';
    $usuario = 'Eduardo.@';
    $password = '1088514H@z';
    $dbName = 'bienesraices';

    $db = new mysqli($hostName, $usuario, $password, $dbName);

    if (!$db) {
        echo "Error no se conecto a la base de datos";
        exit;
    }

    return $db;
}
