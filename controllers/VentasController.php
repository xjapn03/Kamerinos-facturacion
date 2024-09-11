<?php
session_start();
require 'models/VentasModel.php';

class VentasController {
    private $ventaModel;

    public function __construct($db) {
        $this->ventaModel = new VentaModel($db);
    }

    public function index() {
    	$ventas = $this->ventaModel->getAll();
    	require 'views/layout.php';
    	require 'views/Ventas/list.php';    	
    }

    public function new() {
        require 'views/layout.php';
        require 'views/Ventas/new.php';    
    }

    public function save() {    
        $this->ventaModel->newVenta($_POST);
        header('Location: ?controller=venta');
    }

    public function edit() {
        if(isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $venta = $this->ventaModel->getById($id);
            require 'views/layout.php';
            require 'views/Ventas/edit.php';
        } else {
            echo "La Venta No Existe";
        }
    }

    public function update() {
        if(isset($_POST)) {
            $this->ventaModel->editVenta($_POST);
            header('Location: ?controller=venta');
        } else {
            echo "Error, acción no permitida.";    
        }
    }

    public function delete() {        
        $this->ventaModel->deleteVenta($_REQUEST['id']);
        header('Location: ?controller=venta');
    }
}
?>
