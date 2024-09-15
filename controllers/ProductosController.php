<?php
session_start();
require_once 'models/ProductosModel.php';
require_once 'models/Categorias_productosModel.php'; // Para obtener las categorías

class ProductosController {
    private $productoModel;
    private $categoriaProductosModel;

    public function __construct($db) {
        $this->productoModel = new ProductosModel($db);
        $this->categoriaProductosModel = new Categorias_productosModel($db);
    }

    public function index() {
        $productos = $this->productoModel->getAll();
        require 'views/layout.php';
        require 'views/Productos/list.php';
    }

    public function new() {
        $categorias = $this->categoriaProductosModel->getAll();
        require 'views/layout.php';
        require 'views/Productos/new.php';
    }

    public function save() {
        $this->productoModel->newProducto($_POST);
        header('Location: ?controller=productos');
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $producto = $this->productoModel->getById($id);
            $categorias = $this->categoriaProductosModel->getAll();
            require 'views/layout.php';
            require 'views/Productos/edit.php';
        } else {
            echo "El producto no existe";
        }
    }

    public function update() {
        if (isset($_POST)) {
            $this->productoModel->editProducto($_POST);
            header('Location: ?controller=producto');
        } else {
            echo "Error, acción no permitida.";
        }
    }

    public function delete() {
        $this->productoModel->deleteProducto($_REQUEST['id']);
        header('Location: ?controller=producto');
    }
}
?>
