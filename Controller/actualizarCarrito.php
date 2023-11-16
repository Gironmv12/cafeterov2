<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Inicia la sesión si aún no se ha iniciado
/**
 * Inicia la sesión y actualiza el carrito según la acción y la clave del producto recibidos por POST.
 * 
 * @return void
 */
session_start();
include_once('./metodos.php');

if (isset($_POST['productoKey']) && isset($_POST['accion'])) {
    $productoKey = $_POST['productoKey'];
    $accion = $_POST['accion'];

    $carrito = new Carrito();
    $carrito->actualizarCarrito($productoKey, $accion);
}

// Redirige de vuelta a la página de productos en tu caso (ajusta la ruta según tu estructura)
header('Location: ../View/Pages/menu.php');
?>