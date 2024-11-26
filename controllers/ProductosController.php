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
            $id = intval($_REQUEST['id']); // Asegúrate de que el ID sea un entero válido
            
            // Obtener el producto y las categorías desde el modelo
            $producto = $this->productoModel->getById($id);
            $categorias = $this->categoriaProductosModel->getAll();
            
            // Validar que se encontró el producto
            if ($producto && count($producto) > 0) {
                header('Content-Type: application/json'); // Encabezado JSON
                echo json_encode([
                    'producto' => $producto[0],  // Envía el primer elemento
                    'categorias' => $categorias ?: [] // Asegúrate de que sea un array
                ]);
            } else {
                header('Content-Type: application/json'); // Encabezado JSON
                echo json_encode(['error' => 'El producto no existe']);
            }
        } else {
            header('Content-Type: application/json'); // Encabezado JSON
            echo json_encode(['error' => 'ID de producto no especificado']);
        }
    }
      

    public function update() {
        if (isset($_POST)) {
            // Verifica si 'id_producto' está presente, de lo contrario lanza un error
            if (!isset($_POST['id_producto']) || empty($_POST['id_producto'])) {
                die("Error: ID del servicio no proporcionado.");
            }
    
            // Llama al modelo para actualizar el servicio
            $this->productoModel->editProducto($_POST);
    
            // Redirige después de la actualización
            header('Location: ?controller=productos&action=index');
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
