<?php
session_start();
require_once('../Controller/metodos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST["idUsuario"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];

    $metodos = new Usuarios();
    $resultado = $metodos->actualizarUsuario($idUsuario, $nombre, $apellido, $correo, $rol);
    if ($resultado) {
        header("Location: ../view/Pages/admin_usuarios.php");
    } else {
        echo "Hubo un error al actualizar el usuario.";
    }
}
?>