<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- icono de la página -->
    <link rel="icon" href="../../View/images/icono.png" type="png">

    <!-- Enlace a estilos index.css -->
    <link rel="stylesheet" href="../../View/Css/registroUsuarios.css">

    <!-- Título de la página -->
    <title>Registro de usuarios</title>
</head>

<body>

    <div class="parent">
        <div class="div2">
            <p> Café-tero </p>
        </div>

        <div class="div1">

            <div class="card">

                <div class="titulosylogo">
                    <h1>Registro de usuario</h1>
                    <img src="../images/logo-index.png" width="60px" height="60px" alt="">
                </div>

                <div class="Datos">
                    <form action="../../Controller/registro.php" method="post">
                        <div class="nombre">
                            <label for="email">Nombre</label>
                            <input type="text" name="nombre" placeholder="" required>
                        </div>
                        <div class="apellido">
                            <label for="email">Apellido</label>
                            <input type="text" name="apellido" placeholder="" required>
                        </div>
                        <div class="correo">
                            <label for="email">Correo</label>
                            <input type="email" name="email" placeholder="" required>
                        </div>
                        <div class="contraseña">
                            <label for="email">Contraseña</label>
                            <input type="password" name="clave" placeholder="" required>
                        </div>
                        <div class="btn-registrar">
                            <input type="submit" value="Registrarse">
                        </div>

                        <p>¿Ya tiene cuenta? <a href="./login.php">Inicia Sesion</a></p>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>