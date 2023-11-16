<?php
/**
 * Establece la conexión con la base de datos MySQL.
 * @global mysqli $conexion Variable global que almacena la conexión a la base de datos.
 */
global $conexion;
//conexionweb.php
$servidor = "localhost";
$usuario = "root";
$password = "root";
$db = "cafetero";

$conexion = mysqli_connect($servidor, $usuario, $password,$db);

/*if($conexion){
    echo "conexion establecida";
}else{
    echo "no se conecto a la base de datos". mysqli_connect_error();
}*/

mysqli_set_charset($conexion, "utf8");
?>