<?php
session_start();
require_once('../Controller/metodos.php');

/**
 * Actualiza un usuario en la base de datos.
 * 
 * @param int $idUsuario El id del usuario a actualizar.
 * @param string $nombre El nuevo nombre del usuario.
 * @param string $apellido El nuevo apellido del usuario.
 * @param string $correo El nuevo correo del usuario.
 * @param string $rol El nuevo rol del usuario.
 * 
 * @return bool Retorna true si la actualización fue exitosa, de lo contrario retorna false.
 */
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