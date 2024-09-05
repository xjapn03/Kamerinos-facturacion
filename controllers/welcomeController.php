<?php
session_start();
require_once 'models/EmpleadoModel.php';

/**
* Clase Controlador de Bienvenida
**/
class WelcomeController
{
    private $empleadoModel;    

    public function __construct()
    {
        $this->empleadoModel = new EmpleadoModel();    
    }

    /**
     * Metodo de Inicio del controlador
     */
    public function index()
    {
        require 'views/Auth/login.php';
    }

    
    public function home()
    {
      
        $user=$this->empleadoModel->validacion($_POST);
        if( isset($user[0]->id_empleado) ){
                $_SESSION["id_empleado"]=$user[0]->id_empleado;
                $_SESSION["id_rol"]=$user[0]->id_rol;
                $_SESSION["nombre_rol"]=$user[0]->nombre_rol;
                $_SESSION["nombre"]=$user[0]->nombre;
                $_SESSION["apellido"]=$user[0]->apellido;
                $_SESSION["OK"]=1;
            require 'views/layout.php';
            require 'views/home.php';
        }else{
            require 'views/Auth/login.php';
            $_SESSION["id_empleado"]=0;
            $_SESSION["OK"]=0;
        }
    	
    }

    public function inicio()
    {
        if ($_SESSION["OK"] == 1) {
            require 'views/layout.php';
            require 'views/home.php';
        } else {
            require 'views/Auth/login.php';
        }
    }

    public function salir()
    {
        // Limpia las variables de sesión
        $_SESSION["id_empleado"] = 0;
        $_SESSION["OK"] = 0;

        require 'views/Auth/logout.php';     
    }
}
?>