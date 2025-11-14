<?php
class Conexion {
    private static $instancia = null;
    private $conn;

    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $base = "tienda";

    // Constructor privado
    private function __construct() {
        $this->conn = new mysqli($this->host, $this->usuario, $this->password, $this->base);

        if ($this->conn->connect_error) {
            die("Error de conexión: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    // Método estático para obtener la instancia
    public static function obtenerInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    // Método para obtener la conexión (objeto mysqli)
    public function obtenerConexion() {
        return $this->conn;
    }

    private function __clone() { }
}
?>