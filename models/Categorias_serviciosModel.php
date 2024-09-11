<?php
require_once 'db/database.php';

class Categorias_serviciosModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getAll() {
        try {
            $strSql = "SELECT * FROM categorias_servicios";
            return $this->pdo->select($strSql);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $strSql = "SELECT * FROM categorias_servicios WHERE id_categoriaS = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ); // Cambiado a fetch para obtener un solo resultado como un objeto
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

    public function newCategoria($data) {
        try {
            $this->pdo->insert('categorias_servicios', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editCategoria($data) {
        try {
            $strWhere = 'id_categoriaS = ' . $data['id_categoriaS'];
            $this->pdo->update('categorias_servicios', $data, $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteCategoria($id) {
        try {
            $strWhere = 'id_categoriaS = ' . $id;
            $this->pdo->delete('categorias_servicios', $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>
