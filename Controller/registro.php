<?php
session_start();
include('../Model/conexionweb.php');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['email'];
$clave = $_POST['clave'];

// Preparamos una consulta con marcadores de posición (?)
$stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, correo, clave) VALUES (?, ?, ?, ?)");

// Vinculamos los parámetros de la consulta
$stmt->bind_param("ssss", $nombre, $apellido, $correo, $clave);

// Ejecutamos la consulta
if ($stmt->execute()) {
    $_SESSION['registro_exitoso'] = true;
    header("Location: ../View/Pages/login.php");
} else {
    // La consulta no se ha realizado correctamente
    echo "Ha ocurrido un error al registrar al usuario.";
}

// Cerramos la consulta y la conexión
$stmt->close();
$conexion->close();
?>
