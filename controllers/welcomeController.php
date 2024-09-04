<?php
session_start();
require 'models/empleadoModel.php';

/**
* Clase Controlador de Bienvenida
**/
class welcomeController
{
    private $userModel;	

    public function __construct()
    {
   		$this->userModel = new UserModel;    
    }

    /**
     * Metodo de Inicio del controlador
     */
    public function index()
    {
        require 'views/welcome.php';
    }


    public function home()
    {
      
        $user=$this->userModel->validacion($_POST);
        if( isset($user[0]->idUsers) ){
                $_SESSION["idUsers"]=$user[0]->idUsers;
                $_SESSION["rol_id"]=$user[0]->rol_id;
                $_SESSION["rol_name"]=$user[0]->rol_name;
                $_SESSION["name"]=$user[0]->name;
                $_SESSION["idruta"]=$user[0]->idruta;
                $_SESSION["ID_CC"]=$user[0]->ID_CC;
                $_SESSION["tbldocumid"]=$user[0]->tbldocumid;
                $_SESSION["OK"]=1;
            require 'views/layout.php';
            require 'views/home.php';
        }else{
            require 'views/welcome.php';
            $_SESSION["idUsers"]=0;
            $_SESSION["OK"]=0;
        }
    	
    }

    public function inicio()
    {
        if( $_SESSION["OK"]==1 ) {
            require 'views/layout.php';
            require 'views/home.php';
        }else{
            require 'views/welcome.php';
        }   	
    }

    public function salir()
    {
        $_SESSION["idUsers"]=0;
        $_SESSION["OK"]=0;
        require 'views/welcome.php';    	
    }
}