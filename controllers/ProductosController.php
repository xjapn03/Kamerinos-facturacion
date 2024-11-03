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
        require 'views/layout.php';
        require 'views/Productos/new.php';
    }



    public function newAjax() {
        $categorias = $this->categoriaProductosModel->getAll(); // Obtiene solo las categorías
        ob_start(); // Inicia el buffer de salida
        require 'views/Productos/new.php'; // Carga el formulario con las categorías
        $formHtml = ob_get_clean(); // Captura el HTML del formulario
        echo json_encode(['formHtml' => $formHtml]); // Envía el HTML en JSON
    }
    
    

    public function getAlljson() {
        header('Content-Type: application/json'); // Asegúrate de que la respuesta tenga el encabezado correcto
        $productos = $this->productoModel->getAll();
        echo json_encode($producto); // Devuelve las citas en formato JSON
        exit; // Finaliza el script para evitar cargar otras vistas o contenido
    }

    public function save() {
        $this->productoModel->newProducto($_POST);
        header('Location: ?controller=productos');
    }

    public function edit() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            
            // Obtener el producto y las categorías desde el modelo
            $producto = $this->productoModel->getById($id);
            $categorias = $this->categoriaProductosModel->getAll();
            
            if ($producto) {
                // Enviar el producto como un objeto, no un array
                echo json_encode([
                    'producto' => $producto[0],  // Asegurarte de enviar el primer elemento del array
                    'categorias' => $categorias
                ]);
            } else {
                echo json_encode(['error' => 'El producto no existe']);
            }
        } else {
            echo json_encode(['error' => 'ID de producto no especificado']);
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

    public function delete()
    {        
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $this->productoModel->deleteProducto($id);
            header('Location: ?controller=productos&method=index');
        } else {
            echo "Error, no se especificó el ID del usuario a eliminar.";
        }
    }
}
?>
