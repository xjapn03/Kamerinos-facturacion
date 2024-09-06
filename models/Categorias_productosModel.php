<?php
require_once 'db/database.php';

class Categorias_productosModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getAll() {
        try {
            $strSql = "SELECT * FROM categorias_productos";
            return $this->pdo->select($strSql);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $strSql = "SELECT * FROM categorias_productos WHERE id_categoriaP = :id";
            $arrayData = ['id' => $id];
            return $this->pdo->select($strSql, $arrayData);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newCategoria($data) {
        try {
            $this->pdo->insert('categorias_productos', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editCategoria($data) {
        try {
            $strWhere = 'id_categoriaP = ' . $data['id_categoriaP'];
            $this->pdo->update('categorias_productos', $data, $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteCategoria($id) {
        try {
            $strWhere = 'id_categoriaP = ' . $id;
            $this->pdo->delete('categorias_productos', $strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>
