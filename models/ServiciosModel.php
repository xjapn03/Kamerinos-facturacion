<?php
require_once 'db/database.php';

class ServiciosModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db; // Instancia de la clase Database
    }

    public function getAll() {
        try {
            $strSql = "SELECT 
                            servicios.id_servicio, 
                            servicios.nombre_servicio, 
                            servicios.descripcion, 
                            servicios.duracion, 
                            servicios.precio, 
                            categorias_servicios.nombre AS nombre_categoria
                       FROM servicios 
                       INNER JOIN categorias_servicios 
                       ON servicios.fk_categorias_servicios = categorias_servicios.id_categoriaS";
            // Utilizar el método select() de la instancia Database
            return $this->pdo->select($strSql); 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $strSql = "SELECT * FROM servicios WHERE id_servicio = :id";
            $arrayData = ['id' => $id];
            return $this->pdo->select($strSql, $arrayData); // Usar método select de Database
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newServicio($data) {
        try {
            $this->pdo->insert('servicios', $data); // Usar método insert de Database
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editServicio($data) {
        try {
            $strWhere = 'id_servicio = ' . $data['id_servicio'];
            $this->pdo->update('servicios', $data, $strWhere); // Usar método update de Database
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteServicio($id) {
        try {
            $strWhere = 'id_servicio = ' . $id;
            $this->pdo->delete('servicios', $strWhere); // Usar método delete de Database
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>
