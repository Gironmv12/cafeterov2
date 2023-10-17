<?php
// Inicia la sesión si aún no se ha iniciado
session_start();
include_once('./metodos.php');

if (isset($_POST['agregarAlCarrito']) && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    // Crea una instancia de la clase Productos
    $producto = new Productos();

    // Obtén el producto por ID
    // Asegúrate de que el producto se agregue al carrito con la información de la imagen.
    $productoInfo = $producto->obtenerProductoPorID($idProducto);

    if ($productoInfo) {
        // Asegúrate de que $productoInfo sea un arreglo
        if (is_array($productoInfo)) {
            // Agrega el producto al carrito
            $_SESSION['carrito'][] = $productoInfo;
        } else {
            echo "Producto no encontrado.";
        }
    } else {
        echo "Producto no encontrado.";
    }

}


// Redirige de vuelta a la página de productos
header('Location: ../View/Pages/menu.php');
?>
