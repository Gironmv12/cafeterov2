<?php
include('../Model/conexionweb.php');
$conn = conectarbd();

$correo = $_POST["email"];
$clave = $_POST["clave"];

// Validar correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    header("Location: login.php?error=1");
    exit();
}

// Validar contraseña
if (strlen($clave) < 8) {
    header("Location: login.php?error=2");
    exit();
}

// Hashear la contraseña
$contrasena_hash = password_hash($clave, PASSWORD_DEFAULT);

// Consultar la base de datos
$stmt = $conn->prepare("SELECT idUsuario, correo, clave FROM usuarios WHERE correo = :correo AND clave = :clave");
$stmt->bindParam(":correo", $correo);
$stmt->bindParam(":clave", $contrasena_hash);
$stmt->execute();

// Si el usuario existe, iniciar sesión
if ($stmt->rowCount() > 0) {
    $fila = $stmt->fetch();
    $idUsuario = $fila["idUsuario"];
    $correo = $fila["correo"];
    $clave = $fila["clave"];

    // Iniciar sesión
    session_start();
    $_SESSION["idUsuario"] = $idUsuario;
    $_SESSION["correo"] = $correo;
    $_SESSION["clave"] = $clave;

    // Redireccionar a la página principal
    header("Location: index.php");
    exit();
} else {
    // Si el usuario no existe, mostrar un error
    header("Location: login.php?error=3");
    exit();
}

?>