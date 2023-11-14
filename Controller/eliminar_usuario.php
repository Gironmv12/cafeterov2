<?php
session_start();
require_once('../Controller/metodos.php');

if (isset($_GET["id"])) {
    $idUsuario = $_GET["id"];

    $metodos = new Usuarios();
    $resultado = $metodos->EliminarUsuario($idUsuario);
    if ($resultado) {
        header("Location: ../view/Pages/admin_usuarios.php"); // Redirige de vuelta a la página de administración de usuarios
    } else {
        echo "Hubo un error al eliminar el usuario.";
    }
}
?>