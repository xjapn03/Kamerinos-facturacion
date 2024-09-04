<?php
class Database {
    private $host = "localhost";
    private $db_name = "sandra1";
    private $username = "root";  // Usa tu usuario de MySQL
    private $password = "";  // Usa tu contraseña de MySQL
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
