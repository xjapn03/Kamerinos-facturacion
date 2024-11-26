<?php
session_start();
require 'models/ClienteModel.php';

class ClienteController {
    private $clienteModel;

    public function __construct($db) {
        $this->clienteModel = new ClienteModel($db);
    }

    public function getAlljson() {
        header('Content-Type: application/json'); // Asegúrate de que la respuesta tenga el encabezado correcto
        $clientes = $this->clienteModel->getAll();
        echo json_encode($clientes); // Devuelve las citas en formato JSON
        exit; // Finaliza el script para evitar cargar otras vistas o contenido
    }

    public function index() {
    	$clientes = $this->clienteModel->getAll();
    	require 'views/layout.php';
    	require 'views/Cliente/list.php';    	
    }

    public function new() {
        require 'views/layout.php';
        require 'views/Cliente/new.php';    
    }

    public function save() {    
        $this->clienteModel->newCliente($_POST);
        header('Location: ?controller=cliente&method=index');
    }


    public function edit() {
        if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
            $id = intval($_REQUEST['id']); // Asegúrate de que el ID sea un entero válido
            
            // Obtener el cliente desde el modelo
            $cliente = $this->clienteModel->getById($id);
            
            // Validar que se encontró el cliente
            if ($cliente) {
                header('Content-Type: application/json'); // Encabezado JSON
                echo json_encode($cliente);
            } else {
                http_response_code(404); // Establecer código de respuesta HTTP 404
                header('Content-Type: application/json'); // Encabezado JSON
                echo json_encode(['error' => 'El cliente no existe']);
            }
        } else {
            http_response_code(400); // Establecer código de respuesta HTTP 400
            header('Content-Type: application/json'); // Encabezado JSON
            echo json_encode(['error' => 'ID de cliente no especificado o inválido']);
        }
    }


    public function update() {
        if (isset($_POST)) {
            // Verifica si 'id_producto' está presente, de lo contrario lanza un error
            if (!isset($_POST['id_cliente']) || empty($_POST['id_cliente'])) {
                die("Error: ID del cliente no proporcionado.");
            }
    
            // Llama al modelo para actualizar el servicio
            $this->clienteModel->editCliente($_POST);
    
            // Redirige después de la actualización
            header('Location: ?controller=cliente&action=index');
        } else {
            echo "Error, acción no permitida.";
        }
    }

    public function delete() {        
        $this->clienteModel->deleteCliente($_REQUEST['id']);
        header('Location: ?controller=cliente');
    }
}
?>
