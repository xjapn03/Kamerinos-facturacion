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
            // Ajustar las claves del array para que coincidan con las columnas de la tabla
            $dataInsert = [
                'nombre_servicio' => $data['nombre'],
                'descripcion' => isset($data['descripcion']) ? $data['descripcion'] : null, // Asegura que haya un valor, aunque sea null
                'duracion' => $data['duracion'],
                'precio' => $data['precio'],
                'fk_categorias_servicios' => $data['categoria']
            ];
    
            // Insertar el producto en la tabla 'productos'
            $this->pdo->insert('servicios', $dataInsert);
        } catch (PDOException $e) {
            die("Error al insertar: " . $e->getMessage());
        }
    }

    public function editServicio($data) {
        try {
            // Validación básica de campos requeridos
            if (!isset($data['id_servicio']) || empty($data['id_servicio'])) {
                throw new Exception("ID del servicio es obligatorio para actualizar.");
            }
            
            // Preparar los campos para la consulta
            $id_servicio = (int)$data['id_servicio']; // Asegurar que sea entero
            $nombre_servicio = $data['nombre'];
            $precio = $data['precio'];
            $duracion = (int)$data['duracion']; // Asegurar que sea entero
            $descripcion = $data['descripcion'];
            $categoria = (int)$data['categoria']; // Asegurar que sea entero
    
            // Crear la consulta SQL
            $sql = "UPDATE servicios 
                    SET 
                        nombre_servicio = :nombre_servicio,
                        precio = :precio,
                        duracion = :duracion,
                        descripcion = :descripcion,
                        fk_categorias_servicios = :categoria
                    WHERE id_servicio = :id_servicio";
    
            // Preparar y ejecutar la consulta
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nombre_servicio' => $nombre_servicio,
                ':precio' => $precio,
                ':duracion' => $duracion,
                ':descripcion' => $descripcion,
                ':categoria' => $categoria,
                ':id_servicio' => $id_servicio,
            ]);
    
            // Confirmar si se realizó alguna actualización
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                throw new Exception("No se realizó ningún cambio en el servicio.");
            }
        } catch (Exception $e) {
            die("Error al actualizar el servicio: " . $e->getMessage());
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
