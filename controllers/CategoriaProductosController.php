<?php
require_once 'models/Categorias_productosModel.php';

class CategoriaProductosController {
    private $categoriaProductosModel;

    public function __construct($db) {
        $this->categoriaProductosModel = new Categorias_productosModel($db);
    }

    public function index() {
        $categorias = $this->categoriaProductosModel->getAll();
        require 'views/layout.php';
        require 'views/Productos/CategoriaProductos/list.php';
    }

    public function new() {
        require 'views/layout.php';
        require 'views/Productos/CategoriaProductos/new.php';
    }

    public function save() {
        $this->categoriaProductosModel->newCategoria($_POST);
        header('Location: ?controller=categoriaProductos');
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $categoria = $this->categoriaProductosModel->getById($id);
            require 'views/layout.php';
            require 'views/Productos/CategoriaProductos/edit.php';
        } else {
            echo "La categoría no existe";
        }
    }

    public function update() {
        if (isset($_POST)) {
            $this->categoriaProductosModel->editCategoria($_POST);
            header('Location: ?controller=categoriaProductos');
        } else {
            echo "Error, acción no permitida.";
        }
    }

    public function delete() {
        $this->categoriaProductosModel->deleteCategoria($_REQUEST['id']);
        header('Location: ?controller=categoriaProductos');
    }
}
?>