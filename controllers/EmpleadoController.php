<?php
session_start();
require 'models/EmpleadoModel.php';

class EmpleadoController {
    private $empleadoModel;

    public function __construct($db) {
        $this->empleadoModel = new EmpleadoModel($db);
    }

    public function index()
    {
    	$users = $this->empleadoModel->getAll();
    	require 'views/layout.php';
    	require 'views/Empleado/list.php';    	
    }

    public function new()
    {
        require 'views/layout.php';
        require 'views/Empleado/new.php';    
    }

    public function save()
    {    
        //echo "hola";
        //print_r($_POST);
        //die();    
        $this->empleadoModel->newUser($_POST);
        header('Location: ?controller=empleado');
    }

    public function edit()
    {
        if(isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];

            $user = $this->empleadoModel->getById($id);

            require 'views/layout.php';
            require 'views/Empleado/edit.php';
        } else {
            echo "El Usuario No Existe";
        }
    }

    public function update()
    {
        if(isset($_POST)) {
            $this->empleadoModel->editUser($_POST);
            header('Location: ?controller=empleado');
        } else {
            echo "Error, acción no permitida.";    
        }
    }

    public function delete()
    {        
        $this->empleadoModel->deleteUser($_REQUEST);
        header('Location: ?controller=empleado');
    }
}