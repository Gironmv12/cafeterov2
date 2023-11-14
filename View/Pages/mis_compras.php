<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
session_start();
require_once('../../Controller/metodos.php');
$metodos = new Compras();
$idUsuario = $_SESSION['usuario_id']; 
$compras = $metodos->obtenerComprasUsuarios($idUsuario);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- icono de la página -->
    <link rel="icon" href="../images/icono.png" type="png">

    <!-- Enlace a estilos index.css -->
    <link rel="stylesheet" href="../Css/mis_compras.css">

    <!-- Título de la página -->
    <title>Mis compras</title>
    
</head>

<body>
    <div class="app-container">
        <div class="title">
            <h1>Mis compras</h1>
        </div>

        <table>
            <tr>
                <th>ID Compra</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Cantidad</th>
                <th>Precio Compra</th>
                <th>Nombre Producto</th>
                <th>Imagen</th>
            </tr>
            <?php foreach ($compras as $compra): ?>
            <tr>
                <td><?php echo $compra["idCompras"]; ?></td>
                <td><?php echo $compra["fechaCompras"]; ?></td>
                <td><?php echo $compra["monto"]; ?></td>
                <td><?php echo $compra["cantidad"]; ?></td>
                <td><?php echo $compra["precioCompra"]; ?></td>
                <td><?php echo $compra["nombre"]; ?></td>
                <td><img src="../images/productos/<?php echo $compra["image"]; ?>" alt="Porductos" width="100"></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="seguirComprando">
            <a href="menu.php">Seguir comprando</a>
        </div>
    </div>
</body>

</html>