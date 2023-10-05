<?php
//conexionweb.php
$servidor = "localhost";
$usuario = "root";
$password = "root";
$db = "cafetero";

$conexion = mysqli_connect($servidor, $usuario, $password,$db);

/*if($conexion){
    echo "conexion establecida";
}else{
    echo "no se conecto a la base de datos";
}*/
?>