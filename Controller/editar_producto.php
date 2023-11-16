<?php
/**
 * Este archivo se encarga de editar un producto en la base de datos.
 * 
 * @param int $idProducto El id del producto a editar.
 * @param string $nombre El nuevo nombre del producto.
 * @param string $descripcion La nueva descripción del producto.
 * @param float $precio El nuevo precio del producto.
 * @param string $image La nueva imagen del producto.
 * @param int $stock La nueva cantidad de stock del producto.
 * 
 * @return bool Devuelve true si la edición fue exitosa, false en caso contrario.
 */
session_start();
require_once('../Controller/metodos.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];

    // Verificamos si se subió una imagen
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Aquí puedes agregar código para validar la imagen (por ejemplo, verificar su tamaño, tipo, etc.)

        // Movemos la imagen subida a la carpeta de imágenes
        $nombreImagen = $_FILES["image"]["name"];
        $rutaTemporal = $_FILES["image"]["tmp_name"];
        $rutaDestino = "../images/" . $nombreImagen;
        move_uploaded_file($rutaTemporal, $rutaDestino);
    } else {
        // Si no se subió una imagen, utilizamos una cadena vacía
        $nombreImagen = "";
    }

    $metodos = new Productos();
    $resultado = $metodos->EditarProducto($idProducto, $nombre, $descripcion, $precio, $image, $stock);

    if ($resultado) {
        header("Location: ../view/Pages/admin_productos.php");
    } else {
        echo "Hubo un error al editar el producto.";
    }
}
?>