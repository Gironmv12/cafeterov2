<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
</head>

<body>
    <h1>Registro de usuario</h1>

    <form action="../../Controller/registro.php" method="post">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="apellido" placeholder="Apellido">
        <input type="email" name="email" placeholder="Correo electrónico">
        <input type="password" name="clave" placeholder="Contraseña">
        <input type="submit" value="Registrarse">

        <p>¿Ya tiene cuenta? <a href="./login.php">Inicia Sesion</a></p>
    </form>

</body>

</html>