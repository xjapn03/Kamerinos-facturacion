<?php
require_once 'db/database.php';

class ProductosModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db; // Instancia de la clase Database
    }

    public function getAll() {
        try {
            $strSql = "SELECT 
                            productos.id_producto, 
                            productos.nombre_producto, 
                            productos.stock, 
                            productos.precio, 
                            categorias_productos.nombre AS nombre_categoria
                       FROM productos 
                       INNER JOIN categorias_productos 
                       ON productos.fk_categorias_productos = categorias_productos.id_categoriaP";
            // Utilizar el método select() de la instancia Database
            return $this->pdo->select($strSql); 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $strSql = "SELECT * FROM productos WHERE id_producto = :id";
            $arrayData = ['id' => $id];
            return $this->pdo->select($strSql, $arrayData); // Usar método select de Database
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function newProducto($data) {
        try {
            // Ajustar las claves del array para que coincidan con las columnas de la tabla
            $dataInsert = [
                'nombre_producto' => $data['nombre'],
                'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : null, // Asegura que haya un valor, aunque sea null
                'stock' => $data['stock'],
                'precio' => $data['precio'],
                'fk_categorias_productos' => $data['categoria']
            ];
    
            // Insertar el producto en la tabla 'productos'
            $this->pdo->insert('productos', $dataInsert);
        } catch (PDOException $e) {
            die("Error al insertar: " . $e->getMessage());
        }
    }    

    public function editProducto($data) {
        try {
            $strWhere = 'id_producto = ' . $data['id_producto'];
            $this->pdo->update('productos', $data, $strWhere); // Usar método update de Database
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteProducto($id)
    {
        try {            
            $strSql = "DELETE FROM productos WHERE id_producto = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }
}
?>
