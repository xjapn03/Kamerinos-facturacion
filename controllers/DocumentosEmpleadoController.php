<?php
session_start();
require 'models/DocumentosEmpleadoModel.php';

class DocumentosEmpleadoController {
    private $documentosEmpleadoModel;

    public function __construct($db) {
        $this->documentosEmpleadoModel = new DocumentoEmpleadoModel($db);
    }

    public function index() {
        if (isset($_GET['id_empleado'])) {
            $id_empleado = $_GET['id_empleado'];
            $documentos = $this->documentosEmpleadoModel->getDocumentsByEmployeeId($id_empleado);
            require 'views/layout.php';
            require_once 'views/Empleado/Documentos/list.php'; // Vista para listar documentos
        }
    }

    public function delete() {
        if (isset($_POST['id_documento'])) {
            $id_documento = $_POST['id_documento'];
    
            // Obtener el id_empleado del documento
            $id_empleado = $this->documentosEmpleadoModel->getEmployeeIdByDocumentId($id_documento);
    
            // Eliminar el documento
            $this->documentosEmpleadoModel->deleteDocument($id_documento);
    
            // Redirigir al cliente después de eliminar el documento
            header("Location: ?controller=DocumentosEmpleado&action=index&id_empleado=" . $id_empleado);
            exit(); // Asegurarse de que no haya más procesamiento
        }
    }
    

    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_empleado = $_POST['id_empleado'] ?? null;
            $archivo = $_FILES['documento'] ?? null;
    
            if ($id_empleado && $archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                try {
                    // Subir el archivo utilizando el modelo
                    $this->documentosEmpleadoModel->newDocumento(['id_empleado' => $id_empleado], $archivo);
                    $_SESSION['success'] = "Documento subido con éxito.";
                } catch (Exception $e) {
                    $_SESSION['error'] = "Error al subir el documento: " . $e->getMessage();
                }
            } else {
                $_SESSION['error'] = "Falta el archivo o el cliente.";
            }
    
            // Redirigir a la misma página
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
    
    public function downloadFile() {
        if (isset($_GET['id'])) {
            $id_documento = $_GET['id'];
            // Obtener los detalles del archivo desde la base de datos (deberías modificar esta consulta según tu esquema)
            $documento = $this->documentosEmpleadoModel->getDocumentById($id_documento);
    
            // Verificar si el documento existe y si la ruta del archivo es válida
            if ($documento && file_exists($documento['ruta_documento'])) {
                // Configurar los encabezados para la descarga
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($documento['ruta_documento']) . '"');
                header('Content-Length: ' . filesize($documento['ruta_documento']));
                // Enviar el archivo al navegador
                readfile($documento['ruta_documento']);
                exit;
            } else {
                // En caso de que el archivo no exista
                echo "El archivo no existe o ha sido eliminado.";
            }
        } else {
            echo "ID de documento no proporcionado.";
        }
    }
    
    
}
