<?php
session_start();
require_once('../Controller/metodos.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $metodos = new Productos();
    $resultado = $metodos->EliminarProducto($id);

    if ($resultado) {
        header("Location: ../view/Pages/admin_productos.php");
    } else {
        echo "Hubo un error al eliminar el producto.";
    }
}
?>
