<?php
/**
 * Inicia la sesión y requiere el archivo metodos.php.
 * Si se recibe un id por GET, se instancia la clase Productos y se llama al método EliminarProducto con el id recibido.
 * Si se elimina el producto correctamente, redirige a la página de administración de productos.
 * Si no se puede eliminar el producto, muestra un mensaje de error.
 */
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
