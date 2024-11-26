<?php

class DocumentoEmpleadoModel{
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    public function getAll() {
        try {    		
            $strSql = "SELECT * FROM documentos_empleados";
            $stmt = $this->pdo->query($strSql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getDocumentsByEmployeeId($id_empleado) {
        try {
            $strSql = "SELECT * FROM documentos_empleados WHERE id_empleado = :id_empleado";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_empleado' => $id_empleado]);
            $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Añade el tamaño y la extensión de archivo a cada documento
            foreach ($documentos as &$doc) {
                if (file_exists($doc['ruta_documento'])) {
                    $doc['size'] = round(filesize($doc['ruta_documento']) / 1024, 2); // Tamaño en KB
                    $doc['extension'] = pathinfo($doc['ruta_documento'], PATHINFO_EXTENSION); // Calcula la extensión
                } else {
                    $doc['size'] = 0; // Tamaño no disponible
                    $doc['extension'] = 'unknown'; // Extensión desconocida
                }
            }
    
            return $documentos;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
      
    public function getEmployeeIdByDocumentId($id_documento) {
        try {
            $strSql = "SELECT id_empleado FROM documentos_empleados WHERE id_documento = :id_documento";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_documento' => $id_documento]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Retorna el id_empleado del documento
            return $result ? $result['id_empleado'] : null; // Retorna null si no se encuentra
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

    public function getDocumentById($id_documento) {
        try {
            $strSql = "SELECT * FROM documentos_empleados WHERE id_documento = :id_documento";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_documento' => $id_documento]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el documento: " . $e->getMessage());
        }
    }
    

    // Método para registrar un nuevo empleado
    public function newDocumento($data, $archivo) {
        try {
            $id_empleado = $data['id_empleado'];
            $nombre_archivo = basename($archivo['name']);
            $tipo_archivo = $archivo['type'];
            $ruta_temporal = $archivo['tmp_name'];
    
            // Crear el directorio del empleado si no existe
            $directorio_empleado = "uploads/Empleados/" . $id_empleado . "/";
            if (!is_dir($directorio_empleado)) {
                mkdir($directorio_empleado, 0775, true);
            }
    
            $ruta_destino = $directorio_empleado . uniqid() . "_" . $nombre_archivo;
    
            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
                // Insertar en la tabla documentos_empleados
                $sql = "INSERT INTO documentos_empleados (id_empleado, nombre_documento, tipo_documento, ruta_documento, fecha_subida) 
                        VALUES (:id_empleado, :nombre_documento, :tipo_documento, :ruta_documento, NOW())";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'id_empleado' => $id_empleado,
                    'nombre_documento' => $nombre_archivo,
                    'tipo_documento' => $tipo_archivo,
                    'ruta_documento' => $ruta_destino
                ]);
            } else {
                throw new Exception("Error al mover el archivo al destino.");
            }
        } catch (PDOException | Exception $e) {
            throw new Exception("Error al registrar el documento: " . $e->getMessage());
        }
    }    

    public function deleteDocument($id_documento) {
        try {
            $strSql = "DELETE FROM documentos_empleados WHERE id_documento = :id_documento";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_documento' => $id_documento]);
            return $stmt->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

}




?>