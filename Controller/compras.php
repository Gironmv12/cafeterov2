
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
/**
 * Este archivo procesa la compra de los productos en el carrito de compras.
 * 
 * @filesource /c:/MAMP/htdocs/cafeterov2/Controller/compras.php
 * @category Controlador de compras
 * @global array $_SESSION['carrito'] Contiene los productos en el carrito de compras
 * @global int $_SESSION['usuario_id'] Contiene el ID del usuario que realiza la compra
 * @global float $total Contiene el monto total de la compra
 * @global float $montoTotal Contiene el monto total de la compra
 * @global int $idCompra Contiene el ID de la compra realizada
 * @global object $compras Objeto de la clase Compras
 * 
 */
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
    // Insertar detalles de compra para cada producto en el carrito
    foreach ($_SESSION['carrito'] as $producto) {
        $idProducto = $producto['idProducto'];
        $cantidad = $producto['cantidad'];
        $precioCompra = $producto['precio'];

        $resultado = $compras->insertarDetalleCompra($idCompra, $idProducto, $cantidad, $precioCompra);
    }

    unset($_SESSION['carrito']);
}

// Redireccionar a una página de confirmación o cualquier otro destino deseado
header("Location: ../View/Pages/pago.php"); // Cambia esto a la página de destino deseada
exit();
?>
