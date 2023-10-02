<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se haya enviado un formulario POST

    // Incluir el archivo de conexión a la base de datos
    include('../Model/conexionweb.php');

    try {
        // Obtener los datos del formulario
        $email = $_POST["email"];
        $clave = $_POST["clave"];

        // Consulta preparada para obtener el usuario por correo y clave
        $conn = conectarbd();
        $stmt = $conn->prepare("SELECT idUsuario FROM usuarios WHERE correo = :email AND clave = :clave");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':clave', $clave);
        $stmt->execute();

        // Verificar si se encontró un usuario
        if ($stmt->rowCount() == 1) {
            // Iniciar sesión al usuario
            $_SESSION['email'] = $email;
            $_SESSION['clave'] = $clave;

            // Redireccionar al usuario a la página de inicio o a donde desees
            header("Location: ../index.php");
            exit();
        } else {
            // Si no se encontró un usuario, mostrar un mensaje de error
            echo "Correo electrónico o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
