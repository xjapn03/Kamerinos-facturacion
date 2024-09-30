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
        header('Location: ?controller=cliente');
    }

    public function edit() {
        if(isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $cliente = $this->clienteModel->getById($id);
            require 'views/layout.php';
            require 'views/Cliente/edit.php';
        } else {
            echo "El Cliente No Existe";
        }
    }

    public function update() {
        if(isset($_POST)) {
            $this->clienteModel->editCliente($_POST);
            header('Location: ?controller=cliente');
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
