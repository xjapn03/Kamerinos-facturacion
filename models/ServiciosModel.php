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
                            servicios.fk_categorias_servicios, -- Asegúrate de seleccionar la FK también
                            categorias_servicios.nombre AS nombre_categoria
                       FROM servicios 
                       INNER JOIN categorias_servicios 
                       ON servicios.fk_categorias_servicios = categorias_servicios.id_categoriaS";
            return $this->pdo->select($strSql); 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function getAlljson() {
        try {
            $strSql = "SELECT 
                            servicios.id_servicio, 
                            servicios.nombre_servicio, 
                            servicios.descripcion, 
                            servicios.duracion, 
                            servicios.precio, 
                            servicios.fk_categorias_servicios, 
                            categorias_servicios.nombre AS nombre_categoria
                       FROM servicios 
                       INNER JOIN categorias_servicios 
                       ON servicios.fk_categorias_servicios = categorias_servicios.id_categoriaS";
    
            // Ejecutar la consulta y obtener los servicios
            $stmt = $this->pdo->query($strSql);
            $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return json_encode($servicios); // Convertir a JSON
    
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Registrar el error en el log
            return json_encode([]); // Devolver un array vacío en formato JSON en caso de error
        }
    }
    
    
    public function getById($id) {
        try {
            $strSql = "SELECT * FROM servicios WHERE id_servicio = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ); // Obtener un solo resultado como objeto
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
