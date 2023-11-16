<?php
/**
 * Clase para manejar la conexión a la base de datos.
 *
 * Esta clase permite conectarse a una base de datos MySQL utilizando PDO.
 * Los parámetros de conexión son definidos en el constructor de la clase.
 * La función connect() retorna un objeto PDO que puede ser utilizado para realizar consultas a la base de datos.
 *
 * @package bdApi
 */
class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'cafeteroo';
        $this->user = 'root';
        $this->password = 'root';
        $this->charset = 'utf8mb4';
    }

    function connect(){
        try{

            
            $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            //$pdo = new PDO($connection, $this->user, $this->password, $options);
            $pdo = new PDO($connection,$this->user,$this->password);
        
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}

?>