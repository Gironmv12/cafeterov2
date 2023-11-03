<?php
session_start();
require_once('../Controller/metodos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el formulario se ha enviado

    // Recoger los datos del formulario
    $correo = $_POST["email"];
    $clave = $_POST["clave"];

    // Crear una instancia de la clase Usuarios
    $usuarios = new Usuarios();

    // Llamar al método para iniciar sesión
    $usuario = $usuarios->iniciarSesion($correo, $clave);

    if ($usuario) {
        $_SESSION['login_exitoso'] = true;

        // Obtén el ID del usuario de la base de datos
        $idUsuario = $usuarios->obtenerIdUsuario($correo);

        // Guarda el ID del usuario en la sesión
        $_SESSION['usuario_id'] = $idUsuario;

        $_SESSION['usuario_nombre'] = $usuario['nombre']; // Obtén el nombre del usuario de los datos recuperados

        header("Location: ../View/Pages/menu.php");
    } else {
        $_SESSION['login_error'] = "Correo electrónico o contraseña incorrectos.";
        header("Location: ../View/Pages/login.php");
    }
}
?>
