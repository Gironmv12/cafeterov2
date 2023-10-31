<?php
// Incluye el archivo metodos.php para poder utilizar la clase Productos y sus métodos
include('./metodos.php');

// Verifica si se ha enviado una consulta a través de POST
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // Crea una instancia de la clase Productos
    $producto = new Productos();

    // Llama al método buscarProductos para buscar productos en la base de datos
    $productos = $producto->buscarProductos($query);

    // Verifica si se encontraron resultados
    if (!empty($productos)) {
        // Ahora puedes usar $productos en un bucle foreach para mostrar los resultados
        foreach ($productos as $reg) {
            echo '<div class="inner-card">';
            echo '<img src="../images/productos/' . $reg['image'] . '" alt="Producto Photo" class="product-image">';
            echo '<h2 class="product-description">' . $reg['nombre'] . '</h2>';
            echo '<p class="product-description2">' . $reg['descripcion'] . '</p>';
            echo '<p class="product-price">$' . $reg['precio'] . ' MXN</p>';
            echo '<button class="button"></button>';
            echo '</div>';
        }
    } else {
        // No se encontraron resultados de búsqueda
        echo '<img src="../images/error404.png" alt="Error 404" class="product-image404">';
        echo '<p class="text-error">El café que buscas está de camino. ¡Vuelve Pronto!</p>';
    }
} else {
    // Maneja el caso en el que no se envió una consulta
    echo 'No se ha proporcionado una consulta.';
}
