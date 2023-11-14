<?php
session_start();
require_once('../Controller/metodos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $rol = $_POST["rol"];

    $metodos = new Usuarios();
    $resultado = $metodos->CrearUsuario($nombre, $apellido, $correo, $clave, $rol);

    if ($resultado) {
        header("Location: ../view/Pages/admin_usuarios.php");
    } else {
        echo "Hubo un error al crear el usuario.";
    }
}
?>