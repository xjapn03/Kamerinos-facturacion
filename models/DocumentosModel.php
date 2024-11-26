<?php

class DocumentoModel{
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    // Método para obtener todos los clientes
    public function getAll() {
        try {    		
            $strSql = "SELECT * FROM documentos_clientes";
            $stmt = $this->pdo->query($strSql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getDocumentsByClientId($id_cliente) {
        try {
            $strSql = "SELECT * FROM documentos_clientes WHERE id_cliente = :id_cliente";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_cliente' => $id_cliente]);
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
      
    public function getClientIdByDocumentId($id_documento) {
        try {
            $strSql = "SELECT id_cliente FROM documentos_clientes WHERE id_documento = :id_documento";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_documento' => $id_documento]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Retorna el id_cliente del documento
            return $result ? $result['id_cliente'] : null; // Retorna null si no se encuentra
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

    public function getDocumentById($id_documento) {
        try {
            $strSql = "SELECT * FROM documentos_clientes WHERE id_documento = :id_documento";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_documento' => $id_documento]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el documento: " . $e->getMessage());
        }
    }
    

    // Método para registrar un nuevo cliente
    public function newDocumento($data, $archivo) {
        try {
            $id_cliente = $data['id_cliente'];
            $nombre_archivo = basename($archivo['name']);
            $tipo_archivo = $archivo['type'];
            $ruta_temporal = $archivo['tmp_name'];
    
            // Crear el directorio del cliente si no existe
            $directorio_cliente = "uploads/" . $id_cliente . "/";
            if (!is_dir($directorio_cliente)) {
                mkdir($directorio_cliente, 0775, true);
            }
    
            $ruta_destino = $directorio_cliente . uniqid() . "_" . $nombre_archivo;
    
            if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
                // Insertar en la tabla documentos_clientes
                $sql = "INSERT INTO documentos_clientes (id_cliente, nombre_documento, tipo_documento, ruta_documento, fecha_subida) 
                        VALUES (:id_cliente, :nombre_documento, :tipo_documento, :ruta_documento, NOW())";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'id_cliente' => $id_cliente,
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
            $strSql = "DELETE FROM documentos_clientes WHERE id_documento = :id_documento";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_documento' => $id_documento]);
            return $stmt->rowCount(); // Devuelve el número de filas afectadas
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

}




?>