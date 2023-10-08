<?php
include_once './productos.php';
/*class ApiProductos{
    function getAll(){
        $producto = new Productos();
        $productos = array();

        $productos['items'] = array();

        $res = $producto->obtenerProducto();
        if($res-> rowCount()){

            while($row = $res->fetch(PDO::FETCH_ASSOC)){
                $item = array(
                    'id' => $row['idProducto'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'image' => base64_encode($row['image']),
                    'precio' => $row['precio'],
                    'activo' => $row['activo'],
                    'stock' => $row['stock']
                );
                array_push($productos['items'], $item);
            }

            echo json_encode($productos);
        }else{
            echo json_encode(array('mensaje'=> 'No hay elementos registrados'));
        }

    }
}*/


class ApiProductos{
    function getAll(){
        $producto = new Productos();
        $productos = array();

        $productos['items'] = array();

        // Obtén el parámetro de búsqueda de la solicitud (si está presente)
        $query = isset($_GET['query']) ? $_GET['query'] : '';

        // Modifica la consulta SQL para buscar por nombre o descripción
        $sql = "SELECT * FROM productos WHERE nombre LIKE :query OR descripcion LIKE :query";

        $stmt = $producto->connect()->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $item = array(
                    'id' => $row['idProducto'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'image' => base64_encode($row['image']),
                    'precio' => $row['precio'],
                    'activo' => $row['activo'],
                    'stock' => $row['stock']
                );
                array_push($productos['items'], $item);
            }

            echo json_encode($productos);
        } else {
            echo json_encode(array('mensaje' => 'No se encontraron resultados.'));
        }
    }
}
?>

