<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//conectandonos a la base de datos
$db = conecterDB();
$urlBase = url();
$urlAdmin = url() . '/admin';

$pruebaurl = "hola desde includes";

use Model\ActiveRecord;

ActiveRecord::setDB($db, $urlAdmin);
