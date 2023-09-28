<?php
session_start();
include('../Model/conexionweb.php');
$conn = conectarbd();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['email'];
$clave = $_POST['clave'];

// Encriptamos la contraseña
$contrasena_hash = password_hash($clave, PASSWORD_DEFAULT);

// Preparamos una consulta
$stmt = $conn->prepare("INSERT INTO usuarios(nombre, apellido, correo, clave) VALUES(:nombre, :apellido, :email, :clave)");

// Vinculamos los parámetros de la consulta
$stmt->bindParam(":nombre", $nombre);
$stmt->bindParam(":apellido", $apellido);
$stmt->bindParam(":email", $correo);
$stmt->bindParam(":clave", $contrasena_hash);

// Ejecutamos la consulta
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $_SESSION['registro_exitoso'] = true;
    header("Location: ../View/Pages/login.php");

} else {
    // La consulta no se ha realizado correctamente
    echo "Ha ocurrido un error al registrar al usuario.";
}

// Cerramos la conexión
$conn = null;

?>
