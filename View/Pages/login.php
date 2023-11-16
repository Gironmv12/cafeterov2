<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- icono de la página -->
    <link rel="icon" href="../../View/images/icono.png" type="png">

    <!-- Enlace a estilos index.css -->
    <link rel="stylesheet" href="../../View/Css/login.css">

    <!-- Título de la página -->
    <title>Login</title>
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

    <div class="parent">
        <div class="div2">
            <p> Café-tero </p>
        </div>
        <div class="div1">

            <div class="card">

                <div class="titulosylogo">
                    <h1>Iniciar Sesión</h1>
                    <img src="../images/logo-index.png" width="60px" height="60px" alt="">
                </div>

                <div class="Datos">
                    <form action="../../Controller/sesion.php" method="post">
                        <div class="correo">
                            <label for="email">Correo</label>
                            <input type="email" name="email" id="email" placeholder="" required>
                        </div>

                        <div class="contraseña">
                            <label for="clave">Contraseña</label>
                            <input type="password" name="clave" id="clave" placeholder="" required>
                        </div>

                        <div class="btn-registrar">
                            <input type="submit" value="Iniciar sesion">
                        </div>
                        <p>¿No estas registrado? <a href="./registroUsuarios.php">Registrate</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>