<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
        if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso']) {
            // Muestra una alerta de éxito
            echo '<script>
                Swal.fire({
                icon: "success",
                title: "Registro exitoso",
                text: "El registro se ha completado con éxito"
                });
            </script>';
            unset($_SESSION['registro_exitoso']); // Limpia la variable de sesión
        }
        ?>

    <h1>Login</h1>
    <form action="../../Controller/sesion.php" method="post">
        <input type="email" name="email" placeholder="Correo electrónico">
        <input type="password" name="clave" placeholder="Contraseña">
        <input type="submit" value="Registrarse">
    </form>


    <h1>FINALIZACION DE LOGIN</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, autem exercitationem. Aliquam aspernatur veniam expedita dignissimos voluptatem deleniti adipisci rerum, obcaecati, repellat excepturi temporibus quasi ipsa animi. Voluptas, architecto illum?</p>
</body>

</html>