<?php
require_once __DIR__ . '/../Model/bdApi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//CLASE USUARIOS
class Usuarios{
    private $db;

    public function __construct()
    {
        $this->db= new DB();
    }
    public function registrarUsuarios($nombre, $apellido, $correo, $clave){
        try{
            $pdo = $this->db->connect();

            // Verificar si el correo ya existe en la base de datos
            $sql_check = "SELECT COUNT(*) FROM usuarios WHERE correo = :correo";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':correo', $correo);
            $stmt_check->execute();

            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // El correo ya está en uso, no permitir el registro
                return false;
            }

            // Si el correo no existe, proceder con la inserción
            $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave, idRol) VALUES (:nombre, :apellido, :correo, :clave, 2)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':clave', $clave);

            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            return true; // Registro exitoso
        } catch(PDOException $e){
            return false; // Error en el registro
        }
    }

    public function iniciarSesion($correo, $clave){
        try{
            $pdo = $this->db->connect();
            // Preparar la consulta SQL para autenticar al usuario
            $sql = "SELECT * FROM usuarios WHERE correo = :correo AND clave = :clave";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':clave', $clave);

            // Ejecutar la consulta
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cerrar la conexión
            $pdo = null;

            // Iniciar la sesión y almacenar el idRol en la sesión
            if ($usuario) {
                session_start();
                $_SESSION['idRol'] = $usuario['idRol'];
            }

            return $usuario; // Devolver los datos del usuario si la autenticación es exitosa

        }catch(PDOException $e){
            return false;
        }
    }

    public function obtenerIdUsuario($correo){
        try{
            $pdo = $this->db->connect();
            // Preparar la consulta SQL para obtener el ID del usuario
            $sql = "SELECT idUsuario FROM usuarios WHERE correo = :correo";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':correo', $correo);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            $idUsuario = $stmt->fetch(PDO::FETCH_COLUMN);
    
            // Cerrar la conexión
            $pdo = null;
    
            return $idUsuario; // Devolver el ID del usuario
    
        }catch(PDOException $e){
            return false;
        }
    }

    public function CrearUsuario($nombre, $apellido, $correo,$clave, $rol){
        try{
            $pdo = $this->db->connect();
    
            // Verificar si el correo ya existe en la base de datos
            $sql_check = "SELECT COUNT(*) FROM usuarios WHERE correo = :correo";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':correo', $correo);
            $stmt_check->execute();
    
            $count = $stmt_check->fetchColumn();
    
            if ($count > 0) {
                // El correo ya está en uso, no permitir el registro
                return false;
            }
    
            // Si el correo no existe, proceder con la inserción
            $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave, idRol) VALUES (:nombre, :apellido, :correo, :clave, :rol)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':clave', $clave);
            $stmt->bindParam(':rol', $rol);
    
            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            return true; // Registro exitoso
        } catch(PDOException $e){
            return false; // Error en el registro
        }

    }

    public function actualizarUsuario($idUsuario, $nombre, $apellido, $correo, $rol){
        try{
            $pdo = $this->db->connect();

            // Verificar si el correo ya existe en la base de datos
            $sql_check = "SELECT COUNT(*) FROM usuarios WHERE correo = :correo AND idUsuario != :idUsuario";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->bindParam(':correo', $correo);
            $stmt_check->bindParam(':idUsuario', $idUsuario);
            $stmt_check->execute();

            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                // El correo ya está en uso por otro usuario, no permitir la actualización
                return false;
            }

            // Si el correo no existe, proceder con la actualización
            $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, correo = :correo,  idRol = :rol WHERE idUsuario = :idUsuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':rol', $rol);

            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            return true; // Actualización exitosa
        } catch(PDOException $e){
            return false; // Error en la actualización
        }
    }

    public function EliminarUsuario($idUsuario){
        try{
            $pdo = $this->db->connect();
            $sql = "DELETE FROM usuarios WHERE idUsuario = :idUsuario";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();
            $pdo = null;
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    
}

//CLASE PRODUCTOS
class Productos{
    private $db;

    public function __construct()
    {
        $this->db= new DB();
    }

    public function obtenerProductos() {
        try {
            $pdo = $this->db->connect();

            $sql = "SELECT idProducto, nombre, descripcion, image, precio, stock FROM productos WHERE activo = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            // Inicializa un arreglo para almacenar los productos
            $productos = array();

            // Recorre los resultados y agrega cada producto al arreglo
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = array(
                    'idProducto' => $row['idProducto'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'image' => $row['image'],
                    'precio' => $row['precio'],
                    'stock' => $row['stock'],
                );
            }

            // Cierra la conexión
            $pdo = null;

            return $productos; // Devuelve un arreglo de productos

        } catch (PDOException $e) {
            return false; // Manejo de error en la obtención de productos
        }
    }

    public function buscarProductos($query){
        try{
            $pdo = $this->db->connect();
            $sql = "SELECT idProducto, nombre, descripcion, image, precio FROM productos WHERE activo = 1 AND (nombre LIKE :query OR descripcion LIKE :query)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
            $stmt->execute();

            $productos = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productos[] = array(
                    'id' => $row['idProducto'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'image' => $row['image'],
                    'precio' => $row['precio'],
                );
            }

            $pdo = null;
            return $productos;

        }catch(PDOException $e){
            return false;
        }

    }

    public function obtenerProductoPorID($idProducto) {
        try {
            $pdo = $this->db->connect();
    
            $sql = "SELECT idProducto, nombre, descripcion, image, precio, stock FROM productos WHERE activo = 1 AND idProducto = :idProducto";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $stmt->execute();
    
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Cierra la conexión
            $pdo = null;
    
            return $producto; // Devuelve el producto encontrado o false si no se encuentra
    
        } catch (PDOException $e) {
            return false; // Manejo de error en la obtención del producto
        }
    }

    public function agregarProducto($nombre, $descripcion, $precio, $image, $stock, $activo = 1) {
        try {
            $pdo = $this->db->connect();

            $sql = "INSERT INTO productos (nombre, descripcion, precio, image, stock, activo) VALUES (:nombre, :descripcion, :precio, :image, :stock , :activo)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':activo', $activo);

            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            // Devolvemos true para indicar que la inserción fue exitosa
            return true;
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }

    public function editarProducto($idProducto, $nombre, $descripcion, $precio, $image, $stock) {
        try {
            $pdo = $this->db->connect();

            if ($image != "") {
                $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, image = :image, stock = :stock WHERE idProducto = :idProducto";
            } else {
                $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, stock = :stock WHERE idProducto = :idProducto";
            }

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idProducto', $idProducto);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':precio', $precio);
            if ($image != "") {
                $stmt->bindParam(':image', $image);
            }
            $stmt->bindParam(':stock', $stock);

            // Ejecutamos la consulta
            $stmt->execute();

            // Verificamos si se actualizó algún producto
            if ($stmt->rowCount() > 0) {
                // Cerramos la conexión
                $pdo = null;
                // Devolvemos true para indicar que la actualización fue exitosa
                return true;
            } else {
                // Cerramos la conexión
                $pdo = null;
                // Devolvemos false para indicar que no se actualizó ningún producto
                return false;
            }
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }

    public function eliminarProducto($idProducto) {
        try {
            $pdo = $this->db->connect();

            $sql = "DELETE FROM productos WHERE idProducto = :idProducto";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idProducto', $idProducto);

            // Ejecutamos la consulta
            $stmt->execute();

            // Verificamos si se eliminó algún producto
            if ($stmt->rowCount() > 0) {
                // Cerramos la conexión
                $pdo = null;
                // Devolvemos true para indicar que la eliminación fue exitosa
                return true;
            } else {
                // Cerramos la conexión
                $pdo = null;
                // Devolvemos false para indicar que no se eliminó ningún producto
                return false;
            }
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            // Devolvemos false para indicar que hubo un error
            return false;
        }
    }

}

class Carrito{
    private $db;
    private $productos;

    public function __construct(){
        $this->db= new DB();

        $this->productos = &$_SESSION['carrito'];

        if (!is_array($this->productos)) {
            $this->productos = array();
        }
    }

    public function agregarAlCarrito($idProducto) {
        // Crea una instancia de la clase Productos
        $producto = new Productos();

        // Obtén el producto por ID
        $productoInfo = $producto->obtenerProductoPorID($idProducto);

        if ($productoInfo) {
            if (is_array($productoInfo)) {
                // Verifica si el producto ya está en el carrito
                $encontrado = false;
                foreach ($_SESSION['carrito'] as &$productoEnCarrito) {
                    if ($productoEnCarrito['idProducto'] == $productoInfo['idProducto']) {
                        // Si el producto ya está en el carrito, aumenta la cantidad si el stock lo permite
                        if ($productoEnCarrito['cantidad'] < $productoInfo['stock']) {
                            $productoEnCarrito['cantidad']++;
                        }
                        $encontrado = true;
                        break;
                    }
                }

                if (!$encontrado) {
                    // Si el producto no estaba en el carrito, agrega uno nuevo si el stock lo permite
                    if ($productoInfo['stock'] > 0) {
                        $productoInfo['cantidad'] = 1;
                        $_SESSION['carrito'][] = $productoInfo;
                    }
                }
            } else {
                echo "Producto no encontrado.";
            }
        } else {
            echo "Producto no encontrado.";
        }
    }
    public function actualizarCarrito($productoKey, $accion) {
        // Verifica si la clave del producto es válida
        if (isset($this->productos[$productoKey])) {
            $producto = &$this->productos[$productoKey]; // Accede al producto por referencia

            // Realiza la acción correspondiente
            if ($accion === 'restar' && $producto['cantidad'] > 1) {
                $producto['cantidad']--;
            } elseif ($accion === 'sumar' && $producto['cantidad'] < 10) {
                $producto['cantidad']++;
            }
        }
    }
}

class Compras {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function insertarCompra($idUsuario, $montoTotal) {
        try {
            $pdo = $this->db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->beginTransaction();

            $sqlInsertCompra = "INSERT INTO compras (idUsuario, monto, fechaCompras)
                                VALUES (:idUsuario, :montoTotal, NOW())";

            $stmtInsertCompra = $pdo->prepare($sqlInsertCompra);
            $stmtInsertCompra->bindParam(':idUsuario', $idUsuario);
            $stmtInsertCompra->bindParam(':montoTotal', $montoTotal);

            $stmtInsertCompra->execute();

            if ($stmtInsertCompra->rowCount() == 0) {
                throw new Exception("Error al insertar compra");
            }

            $idCompra = $pdo->lastInsertId();

            $pdo->commit();

            return $idCompra;
        } catch (Exception $e) {
            $pdo->rollback();
            return false;
        } finally {
            $pdo = null;
        }
    }
    
    

    public function insertarDetalleCompra($idCompra, $idProducto, $cantidad, $precioCompra) {
        try {
            // Validaciones
            if ($idCompra <= 0 || $idProducto <= 0 || $cantidad <= 0 || $precioCompra <= 0) {
                return false;
            }
    
            $pdo = $this->db->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $pdo->beginTransaction();
    
            // Sólo idCompra en la query
            $sqlInsertDetalle = "INSERT INTO detalle_compra (idProducto, idCompras, cantidad, precioCompra) 
                               VALUES (:idProducto, :idCompras, :cantidad, :precioCompra)";
    
            $stmtInsertDetalle = $pdo->prepare($sqlInsertDetalle);
            $stmtInsertDetalle->bindParam(':idProducto', $idProducto);
            $stmtInsertDetalle->bindParam(':idCompras', $idCompra);
            $stmtInsertDetalle->bindParam(':cantidad', $cantidad);
            $stmtInsertDetalle->bindParam(':precioCompra', $precioCompra);
    
            // Ejecutar query
            $stmtInsertDetalle->execute();
    
            // Validar antes de commit
            if ($stmtInsertDetalle->rowCount() == 0) {
                // Imprimir error de la consulta
                var_dump($stmtInsertDetalle->errorInfo());
                throw new Exception("Error al insertar detalle");
            }
    
            $pdo->commit();
            return true;
        } catch (Exception $e) {
            // Imprimir excepción
            var_dump($e->getMessage());
            $pdo->rollback();
            return false;
        } finally {
            $pdo = null;
        }
    }

    public function obtenerCompras(){
        try{
            $pdo = $this->db->connect();
            $sql = "SELECT compras.idCompras, compras.fechaCompras, compras.monto, detalle_compra.cantidad, detalle_compra.precioCompra, productos.nombre, usuarios.nombre as nombreUsuario, usuarios.apellido
                FROM compras
                INNER JOIN detalle_compra ON compras.idCompras = detalle_compra.idCompras
                INNER JOIN productos ON detalle_compra.idProducto = productos.idProducto
                INNER JOIN usuarios ON compras.idUsuario = usuarios.idUsuario
                ORDER BY compras.fechaCompras DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Obtenemos todas las compras
        $compras = $stmt->fetchAll();

        // Cerramos la conexión
        $pdo = null;

        return $compras;
    } catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
    }
    }

    public function obtenerComprasUsuarios($idUsuario){
        try {
            $pdo = $this->db->connect();
    
            $sql = "SELECT compras.idCompras, compras.fechaCompras, compras.monto, detalle_compra.cantidad, detalle_compra.precioCompra, productos.nombre, productos.image
                FROM compras
                INNER JOIN detalle_compra ON compras.idCompras = detalle_compra.idCompras
                INNER JOIN productos ON detalle_compra.idProducto = productos.idProducto
                WHERE compras.idUsuario = :idUsuario
                ORDER BY compras.fechaCompras DESC";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario);
            $stmt->execute();
    
            // Obtenemos todas las compras del usuario
            $compras = $stmt->fetchAll();
    
            // Cerramos la conexión
            $pdo = null;
    
            return $compras;
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }

    }
    
}

?>