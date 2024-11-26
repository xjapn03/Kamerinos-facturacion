<?php
session_start();
require_once 'models/ServiciosModel.php';
require_once 'models/Categorias_serviciosModel.php'; // Para obtener las categorías

class ServiciosController {
    private $servicioModel;
    private $categoriaServiciosModel;

    public function __construct($db) {
        $this->servicioModel = new ServiciosModel($db);
        $this->categoriaServiciosModel = new Categorias_serviciosModel($db);
    }


    public function getAlljson() {
        header('Content-Type: application/json'); // Asegúrate de que la respuesta tenga el encabezado correcto
        $servicios = $this->servicioModel->getAll();
        echo json_encode($servicios); // Devuelve las citas en formato JSON
        exit; // Finaliza el script para evitar cargar otras vistas o contenido
    }

    public function index() {
        $servicios = $this->servicioModel->getAll();
        require 'views/layout.php';
        require 'views/Servicios/list.php';
    }

    public function new() {
        $categorias = $this->categoriaServiciosModel->getAll();
        require 'views/layout.php';
        require 'views/Servicios/new.php';
    }

    public function save() {
        $this->servicioModel->newServicio($_POST);
        header('Location: ?controller=servicios');
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $servicio = $this->servicioModel->getById($id);
            $categorias = $this->categoriaServiciosModel->getAll();
            require 'views/layout.php';
            require 'views/Servicios/edit.php';
        } else {
            echo "El servicio no existe";
        }
    }

    public function update() {
        if (isset($_POST)) {
            // Verifica si 'id_servicio' está presente, de lo contrario lanza un error
            if (!isset($_POST['id_servicio']) || empty($_POST['id_servicio'])) {
                die("Error: ID del servicio no proporcionado.");
            }
    
            // Llama al modelo para actualizar el servicio
            $this->servicioModel->editServicio($_POST);
    
            // Redirige después de la actualización
            header('Location: ?controller=servicios&action=index');
        } else {
            echo "Error, acción no permitida.";
        }
    }
    

    public function delete() {
        $this->servicioModel->deleteServicio($_REQUEST['id']);
        header('Location: ?controller=servicios&action=index');
    }
}
?>
