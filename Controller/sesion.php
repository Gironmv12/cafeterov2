<?php
session_start();
include('../Model/conexionweb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se haya enviado un formulario POST

    $email = $_POST["email"];
    $clave = $_POST["clave"];

    // Preparamos una consulta para obtener el usuario por correo y clave
    $stmt = $conexion->prepare("SELECT idUsuario FROM usuarios WHERE correo = ? AND clave = ?");
    $stmt->bind_param("ss", $email, $clave);

    // Ejecutamos la consulta
    $stmt->execute();

    // Obtenemos el resultado de la consulta
    $stmt->bind_result($idUsuario);

    if ($stmt->fetch()) {
        $_SESSION['login_exitoso'] = true;

        // Redireccionar al usuario a la página de inicio o a donde desees
        header("Location: ../View/Pages/menu.php");
        exit();
    } else {
        // Si no se encontró un usuario, mostrar un mensaje de error
        $_SESSION['login_error'] = "Correo electrónico o contraseña incorrectos.";
        header("Location: ../View/Pages/login.php");
        exit();
    }

    // Cerramos la consulta
    $stmt->close();
}

// Cerramos la conexión
$conexion->close();
?>
