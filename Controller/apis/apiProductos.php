<?php
include_once './productos.php';
class ApiProductos{
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
}

?>