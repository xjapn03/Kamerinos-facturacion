<?php
require_once 'db/Database.php'; // Incluye la conexión a la base de datos

class empleado {
    private $conn;
    private $table_name = "empleados";
    public $id_empleado;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $direccion;
    public $fecha_registro;
    public $fecha_nacimiento;
    public $documento_contrato;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para verificar el login de un empleado
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verifica la contraseña cifrada
            if (password_verify($password, $empleado['password'])) {
                // Obtener el rol del empleado
                $id_rol = $this->getRole($empleado['id_empleado']);
                $empleado['rol'] = $id_rol;
                return $empleado;
            }
        }
        return false;
    }

    // Método para obtener el rol de un empleado
    private function getRole($id_empleado) {
        $query = "SELECT r.nombre FROM roles AS r 
                  JOIN roles_empleados AS re ON r.id_rol = re.id_rol 
                  WHERE re.id_empleado = :id_empleado";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return $role['nombre'];
        }
        return null;
    }

    // Método para obtener todos los empleados
    public function getEmpleados() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Método para registrar un nuevo empleado
    public function register($nombre, $apellido, $telefono, $email, $direccion, $fecha_nacimiento, $password, $id_rol) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellido, telefono, email, direccion, fecha_nacimiento, password) 
                  VALUES (:nombre, :apellido, :telefono, :email, :direccion, :fecha_nacimiento, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':password', $hashed_password);

        try {
            $stmt->execute();
            // Obtener el ID del nuevo empleado
            $id_empleado = $this->conn->lastInsertId();
            // Asociar el empleado con el rol
            $this->assignRole($id_empleado, $id_rol);
            return true;
        } catch (PDOException $e) {
            // Maneja el error (log, mostrar mensaje al usuario, etc.)
            echo "Error al registrar empleado: " . $e->getMessage();
            return false;
        }
    }

    // Método para asignar un rol a un empleado
    private function assignRole($id_empleado, $id_rol) {
        $query = "INSERT INTO roles_empleados (id_empleado, id_rol) VALUES (:id_empleado, :id_rol)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_empleado', $id_empleado);
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->execute();
    }
}
?>
