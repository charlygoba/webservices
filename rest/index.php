<?php
 
//Cargamos el framework
require_once 'vendor/autoload.php';
 
$app = new \Slim\Slim();
 
//Creamos la conexión a la base de datos con MySQLi
$db = new mysqli('localhost', 'root', '', 'apis');
 
/*
 * Ruta/Controlador Get, le decimos que use las variables $db, $app
 * GET para CONSEGUIR
 */

?>
