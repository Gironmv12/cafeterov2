<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Inicia la sesión si aún no se ha iniciado
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
