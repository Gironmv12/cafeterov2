<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
/**
 * Agrega un producto a la base de datos.
 *
 * @param string $nombre Nombre del producto.
 * @param string $descripcion Descripción del producto.
 * @param float $precio Precio del producto.
 * @param string $nombreImagen Nombre de la imagen del producto.
 * @param int $stock Cantidad de stock del producto.
 * @param int $activo Estado del producto (1 = activo, 0 = inactivo).
 *
 * @return bool Retorna true si el producto se agregó correctamente, de lo contrario retorna false.
 */
session_start();
require_once('../Controller/metodos.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio']);
    $stock = $_POST['stock'];

    // Manejo de la carga de la imagen
    $nombreImagen = $_FILES['image']['name'];
    $rutaTemporal = $_FILES['image']['tmp_name'];
    $rutaDestino = "../View/images/productos/" . $nombreImagen;
    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        $metodos = new Productos();
        $resultado = $metodos->agregarProducto($nombre, $descripcion, $precio, $nombreImagen, $stock, $activo = 1);
    } else {
        echo "Hubo un error al cargar la imagen.";
    }

    if ($resultado) {
        header("Location: ../view/Pages/admin_productos.php");
    } else {
        echo "Hubo un error al agregar el producto.";
    }
}

?>