<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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