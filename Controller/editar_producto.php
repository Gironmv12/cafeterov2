<?php
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