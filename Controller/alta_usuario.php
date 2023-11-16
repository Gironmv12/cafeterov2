<?php
/**
 * Este archivo es responsable de crear un nuevo usuario en la base de datos.
 * Si se recibe una solicitud POST, se recopilan los datos del formulario y se llama al método CrearUsuario de la clase Usuarios.
 * Si el usuario se crea correctamente, se redirige a la página de administración de usuarios.
 * De lo contrario, se muestra un mensaje de error.
 *
 * @param string $_POST["nombre"] El nombre del usuario.
 * @param string $_POST["apellido"] El apellido del usuario.
 * @param string $_POST["correo"] El correo electrónico del usuario.
 * @param string $_POST["clave"] La contraseña del usuario.
 * @param string $_POST["rol"] El rol del usuario.
 * @return void
 */
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