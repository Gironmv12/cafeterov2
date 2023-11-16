<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Inicia la sesión si aún no se ha iniciado
/**
 * Inicia la sesión y agrega un producto al carrito.
 * 
 * Si se ha enviado el formulario de agregar al carrito y se ha recibido el id del producto,
 * se crea una instancia de la clase Carrito y se agrega el producto al carrito.
 * 
 * Finalmente, se redirige de vuelta a la página de productos.
 */

session_start();
include_once('./metodos.php');

if (isset($_POST['agregarAlCarrito']) && isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];

    $carrito = new Carrito();
    $carrito->agregarAlCarrito($idProducto);
}

// Redirige de vuelta a la página de productos
header('Location: ../View/Pages/menu.php');
?>
