<?php
require_once __DIR__ . '/../Model/bdApi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/**
 * Clase Usuarios - Contiene métodos para registrar, autenticar, actualizar y eliminar usuarios en la base de datos.
 * Clse Productos - Contiene metodos para obtener, buscar, agregar, editar y eliminar productos en la base de datos.
 * Clase Carrito - Contiene métodos para agregar y actualizar productos en el carrito de compras.
 * Clase Compras - Contiene métodos para insertar compras y detalles de compra en la base de datos.
 *
 * @author Francisco Javier Lopez Giron & Pablo Gamaliel Martínez González 
 * @version 1.0
 */
class Usuarios{
    private $db;

    public function __construct()
    {
        $this->db= new DB();
    }
    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param string $nombre Nombre del usuario.
     * @param string $apellido Apellido del usuario.
     * @param string $correo Correo electrónico del usuario.
     * @param string $clave Clave de acceso del usuario.
     *
     * @return bool Retorna true si el registro fue exitoso, de lo contrario retorna false.
     */
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
    
            // Encriptar la contraseña
            $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT);
    
            // Si el correo no existe, proceder con la inserción
            $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave, idRol) VALUES (:nombre, :apellido, :correo, :clave, 2)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':clave', $clave_encriptada);
    
            // Ejecutamos la consulta
            $stmt->execute();
            // Cerramos la conexión
            $pdo = null;
            return true; // Registro exitoso
        } catch(PDOException $e){
            return false; // Error en el registro
        }
    }


    /**
     * Inicia sesión de usuario.
     *
     * @param string $correo Correo electrónico del usuario.
     * @param string $clave Clave de acceso del usuario.
     * @return array|false Devuelve los datos del usuario si la autenticación es exitosa, de lo contrario devuelve false.
     */
    public function iniciarSesion($correo, $clave){
        try{
            $pdo = $this->db->connect();
            // Preparar la consulta SQL para obtener al usuario
            $sql = "SELECT * FROM usuarios WHERE correo = :correo";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':correo', $correo);

            // Ejecutar la consulta
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Cerrar la conexión
            $pdo = null;

            // Verificar la contraseña
            if ($usuario && password_verify($clave, $usuario['clave'])) {
                // Iniciar la sesión y almacenar el idRol en la sesión
                session_start();
                $_SESSION['idRol'] = $usuario['idRol'];
                return $usuario; // Devolver los datos del usuario si la autenticación es exitosa
            } else {
                return false; // Autenticación fallida
            }

        }catch(PDOException $e){
            return false;
        }
    }

    /**
     * Obtiene el ID del usuario a partir de su correo electrónico.
     *
     * @param string $correo Correo electrónico del usuario.
     * @return mixed Devuelve el ID del usuario si se encuentra en la base de datos, de lo contrario devuelve false.
     */
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

    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @param string $nombre El nombre del usuario.
     * @param string $apellido El apellido del usuario.
     * @param string $correo El correo electrónico del usuario.
     * @param string $clave La contraseña del usuario.
     * @param int $rol El ID del rol del usuario.
     * @return bool Retorna verdadero si el registro es exitoso, falso si hay un error o el correo ya está en uso.
     */
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

    /**
     * Actualiza un usuario en la base de datos.
     *
     * @param int $idUsuario El id del usuario a actualizar.
     * @param string $nombre El nuevo nombre del usuario.
     * @param string $apellido El nuevo apellido del usuario.
     * @param string $correo El nuevo correo del usuario.
     * @param int $rol El nuevo rol del usuario.
     * @return bool Retorna true si la actualización fue exitosa, false en caso contrario.
     */
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

    /**
     * Elimina un usuario de la base de datos.
     *
     * @param int $idUsuario El id del usuario a eliminar.
     * @return bool Retorna true si se eliminó correctamente, false en caso contrario.
     */
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

    /**
     * Obtiene todos los productos activos de la base de datos.
     *
     * @return array|false Un arreglo de productos si la consulta es exitosa, o false si hay un error.
     */
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

    /**
     * Busca productos en la base de datos que coincidan con una consulta dada.
     *
     * @param string $query La consulta a buscar.
     * @return array|false Un array de productos que coinciden con la consulta o false si ocurre un error.
     */
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

    /**
     * Obtiene un producto por su ID.
     *
     * @param int $idProducto El ID del producto a buscar.
     *
     * @return mixed Devuelve un array con los datos del producto encontrado o false si no se encuentra.
     */
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

    /**
     * Agrega un producto a la base de datos.
     *
     * @param string $nombre Nombre del producto.
     * @param string $descripcion Descripción del producto.
     * @param float $precio Precio del producto.
     * @param string $image Ruta de la imagen del producto.
     * @param int $stock Cantidad de stock del producto.
     * @param int $activo (opcional) Indica si el producto está activo o no. Por defecto es 1 (activo).
     * @return bool Devuelve true si la inserción fue exitosa, false en caso contrario.
     */
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

    /**
     * Actualiza un producto en la base de datos.
     *
     * @param int $idProducto El ID del producto a actualizar.
     * @param string $nombre El nuevo nombre del producto.
     * @param string $descripcion La nueva descripción del producto.
     * @param float $precio El nuevo precio del producto.
     * @param string $image La nueva imagen del producto.
     * @param int $stock La nueva cantidad de stock del producto.
     * @return bool Devuelve true si la actualización fue exitosa, false en caso contrario.
     */
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

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $idProducto El id del producto a eliminar.
     * @return bool Devuelve true si la eliminación fue exitosa, false si no se eliminó ningún producto o hubo un error.
     */
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

    /**
     * Constructor de la clase Metodos.
     * Crea una instancia de la clase DB y asigna la referencia del carrito de compras a la variable $productos.
     * Si el carrito de compras no es un array, lo inicializa como tal.
     */
    public function __construct(){
        $this->db= new DB();

        $this->productos = &$_SESSION['carrito'];

        if (!is_array($this->productos)) {
            $this->productos = array();
        }
    }

    /**
     * Agrega un producto al carrito de compras.
     *
     * @param int $idProducto El ID del producto a agregar.
     *
     * @return void
     */
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
    /**
     * Actualiza la cantidad de un producto en el carrito de compras.
     *
     * @param int $productoKey La clave del producto en el carrito.
     * @param string $accion La acción a realizar ('restar' o 'sumar').
     * @return void
     */
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

    /**
     * Inserta una nueva compra en la base de datos.
     *
     * @param int $idUsuario El ID del usuario que realizó la compra.
     * @param float $montoTotal El monto total de la compra.
     * @return int|false El ID de la compra insertada o false si hubo un error.
     */
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
    
    

    /**
     * Inserta un detalle de compra en la base de datos.
     *
     * @param int $idCompra El id de la compra.
     * @param int $idProducto El id del producto.
     * @param int $cantidad La cantidad de productos comprados.
     * @param float $precioCompra El precio de compra del producto.
     * @return bool Retorna true si se insertó el detalle de compra correctamente, de lo contrario retorna false.
     */
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

    /**
     * Obtiene todas las compras realizadas por un usuario específico.
     *
     * @param int $idUsuario El ID del usuario del cual se quieren obtener las compras.
     * @return array|false Un array con todas las compras realizadas por el usuario, o false si ocurre un error.
     */
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

//AGREGAR ELEMENTOS FALTANTES
//VISTA DE INVENTARIO LA CUAL MOSTRATARA UNA GRAFICAS DE LOS PRODUCTOS MAS VENDIDOS AL MENOS VENDIDO

?>