<?php
session_start();
include('../Model/conexionweb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $clave = $_POST["clave"];

    // Preparar consulta para verificar el inicio de sesión
    $stmt = $conexion->prepare("SELECT idUsuario, nombre FROM usuarios WHERE correo = ? AND clave = ?");
    $stmt->bind_param("ss", $email, $clave);
    $stmt->execute();
    $stmt->bind_result($idUsuario, $nombreUsuario);

    if ($stmt->fetch()) {
        // Si el inicio de sesión es exitoso
        $_SESSION['login_exitoso'] = true;
        $_SESSION['usuario_nombre'] = $nombreUsuario;

        header("Location: ../View/Pages/menu.php");
        exit();
    } else {
        // Si no se encontró un usuario, mostrar un mensaje de error
        $_SESSION['login_error'] = "Correo electrónico o contraseña incorrectos.";
        header("Location: ../View/Pages/login.php");
        exit();
    }

    $stmt->close();
}

$conexion->close();
?>
