<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link de heroicons -->
    <link href="https://cdn.jsdelivr.net/npm/heroicons@1.0.1/dist/heroicons.min.css" rel="stylesheet">

    <!-- icono de la página -->
    <link rel="icon" href="../images/icono.png" type="png">

    <!-- Enlace a estilos index.css -->
    <link rel="stylesheet" href="../Css/menu.css">

    <!-- Título de la página -->
    <title>Menu</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php
        if (isset($_SESSION['login_exitoso']) && $_SESSION['login_exitoso']) {
            // Muestra una alerta de éxito
            echo '<script>
                Swal.fire({
                icon: "success",
                title: "login exitoso",
                text: "El login se ha completado con éxito"
                });
            </script>';
            unset($_SESSION['login_exitoso']); // Limpia la variable de sesión
        }
        ?>
    <h1>Menu index</h1>
</body>

</html>