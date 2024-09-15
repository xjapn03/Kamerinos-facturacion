<?php
session_start();
require_once 'models/Categorias_serviciosModel.php';

class CategoriaServiciosController {
    private $categoriaServiciosModel;

    public function __construct($db) {
        $this->categoriaServiciosModel = new Categorias_serviciosModel($db);
    }

    public function index() {
        $categorias = $this->categoriaServiciosModel->getAll();
        require 'views/layout.php';
        require 'views/Servicios/CategoriaServicios/list.php';
    }

    public function new() {
        require 'views/layout.php';
        require 'views/Servicios/CategoriaServicios/new.php';
    }

    public function save() {
        $this->categoriaServiciosModel->newCategoria($_POST);
        header('Location: ?controller=categoriaServicios');
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $categoria = $this->categoriaServiciosModel->getById($id);
            require 'views/layout.php';
            require 'views/Servicios/CategoriaServicios/edit.php';
        } else {
            echo "La categoría no existe";
        }
    }

    public function update() {
        if (isset($_POST)) {
            $this->categoriaServiciosModel->editCategoria($_POST);
            header('Location: ?controller=categoriaServicios');
        } else {
            echo "Error, acción no permitida.";
        }
    }

    public function delete() {
        $this->categoriaServiciosModel->deleteCategoria($_REQUEST['id']);
        header('Location: ?controller=categoriaServicios');
    }
}
?>
