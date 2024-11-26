<?php

class ClienteModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    // Método para obtener todos los clientes
    public function getAll() {
        try {    		
            $strSql = "SELECT * FROM clientes";
            $stmt = $this->pdo->query($strSql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para obtener un cliente por ID
    public function getById($id) {
        try {
            $strSql = "SELECT * FROM clientes WHERE id_cliente = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            return $cliente ?: null; // Devolver null si no se encuentra el cliente
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

    // Método para registrar un nuevo cliente
    public function newCliente($data) {   
        try {
            $sql = "INSERT INTO clientes (nombre, apellido, telefono, email, direccion, fecha_nacimiento, fecha_registro) 
                    VALUES (:nombre, :apellido, :telefono, :email, :direccion, :fecha_nacimiento, NOW())";
            
            $stmt = $this->pdo->prepare($sql);
            
            // Ejecutamos la consulta, sin incluir fecha_registro
            $stmt->execute([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'direccion' => $data['direccion'],
                'fecha_nacimiento' => $data['fechaNacimiento']
            ]);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    

    // Método para editar un cliente
    public function editCliente($data) {
        try {      
            $strSql = "UPDATE clientes SET nombre = :nombre, apellido = :apellido, telefono = :telefono, 
                        email = :email, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento 
                        WHERE id_cliente = :id_cliente";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'direccion' => $data['direccion'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'id_cliente' => $data['id_cliente']
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }

    // Método para eliminar un cliente
    public function deleteCliente($id) {
        try {            
            $strSql = "DELETE FROM clientes WHERE id_cliente = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }
}
?>
