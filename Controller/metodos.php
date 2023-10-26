<?php
require_once('C:\MAMP\htdocs\cafeterov2\Model\bdApi.php');

//CLASE USUARIOS
class Usuarios{
    private $db;

    public function __construct()
    {
        $this->db= new DB();
    }
    public function registrarUsuarios($nombre, $apellido, $correo,$clave){
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
            $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave) VALUES (:nombre, :apellido, :correo, :clave)";
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

            return $usuario; // Devolver los datos del usuario si la autenticación es exitosa

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

            $sql = "SELECT idProducto, nombre, descripcion, image, precio FROM productos WHERE activo = 1";
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
    
            $sql = "SELECT idProducto, nombre, descripcion, image, precio FROM productos WHERE activo = 1 AND idProducto = :idProducto";
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
                foreach ($this->productos as &$productoEnCarrito) {
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
                        $this->productos[] = $productoInfo;
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

?>