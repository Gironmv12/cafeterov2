<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();

if (isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    // Asegúrate de que la sesión del carrito exista
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $key => $producto) {
            if (isset($producto['idProducto']) && $producto['idProducto'] === $idProducto) {
                // Mensaje de depuración para verificar el ID del producto
                echo 'Producto a eliminar: ' . $idProducto . '<br>';
                
                unset($_SESSION['carrito'][$key]);
                $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reorganiza los índices
                
                // Mensaje de depuración para verificar que el producto se eliminó
                echo 'Producto eliminado del carrito<br>';
                break; // Sal del bucle una vez que se haya encontrado y eliminado el producto
            }
        }
    } else {
        // Mensaje de depuración para verificar si la sesión del carrito existe
        echo 'Sesión del carrito no encontrada<br>';
    }
}

// Redirige de vuelta a la página del carrito
header('Location: ../View/Pages/menu.php');
exit;

?>