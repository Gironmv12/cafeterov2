<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
include('./metodos.php');
$compras = new Compras();
$idUsuario = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['total'])) {
        $total = floatval($_POST['total']);
        // Resto del código para procesar la compra
    }
}

$montoTotal = $total;

// Insertar la compra
$idCompra = $compras->insertarCompra($idUsuario, $montoTotal);

if($idCompra !== false){
// Insertar detalles de compra para cada producto en el carrito
    foreach ($_SESSION['carrito'] as $producto) {
        $idProducto = $producto['idProducto'];
        $cantidad = $producto['cantidad'];
        $precioCompra = $producto['precio'];

        $compras->insertarDetalleCompra($idCompra, $idProducto, $cantidad, $precioCompra);
    }

    unset($_SESSION['carrito']);
}

// Redireccionar a una página de confirmación o cualquier otro destino deseado
header("Location: ../View/Pages/pago.php"); // Cambia esto a la página de destino deseada
exit();
?>
