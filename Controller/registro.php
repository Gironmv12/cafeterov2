<?php
session_start();
require_once('../Controller/metodos.php');

/**
 * Verifica si el formulario se ha enviado y registra un nuevo usuario en la base de datos.
 *
 * @param string $_POST["nombre"] El nombre del usuario.
 * @param string $_POST["apellido"] El apellido del usuario.
 * @param string $_POST["email"] El correo electrónico del usuario.
 * @param string $_POST["clave"] La contraseña del usuario.
 *
 * @return bool Retorna true si el registro fue exitoso, de lo contrario retorna false.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el formulario se ha enviado

    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["email"]; // El nombre debe coincidir con el campo del formulario
    $clave = $_POST["clave"];

    // Crear una instancia de la clase Usuarios
    $usuarios = new Usuarios();

    // Llamar al método para registrar usuarios
    if ($usuarios->registrarUsuarios($nombre, $apellido, $correo, $clave)) {
        // Registro exitoso
        $_SESSION['registro_exitoso'] = true;
        header("Location: ../view/Pages/login.php");
    } else {
        // Error en el registro
        echo "Error en el registro. Inténtalo de nuevo.";
    }
}
?>
