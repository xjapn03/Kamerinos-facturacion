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
            $this->servicioModel->editServicio($_POST);
            header('Location: ?controller=servicio');
        } else {
            echo "Error, acción no permitida.";
        }
    }

    public function delete() {
        $this->servicioModel->deleteServicio($_REQUEST['id']);
        header('Location: ?controller=servicio');
    }
}
?>
