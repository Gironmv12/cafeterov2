<?php
include_once '../../Model/bdApi.php';

class Productos extends DB{
    function obtenerProducto(){
        $query = $this->connect()->query('SELECT * FROM productos');

        return $query;
    }
}
?>