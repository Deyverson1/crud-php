<?php //base de datos

$servidor = "sql111.infinityfree.com"; 
$baseDeDatos = "if0_35006081_app"; 
$usuario = "if0_35006081"; 
$contrasena = "@Valhalla_07"; 

//consultar la base de datos
try {
// PDO Php data objects
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contrasena);
} catch (Exception $ex){
    echo $ex->getMessage();
}


































?>