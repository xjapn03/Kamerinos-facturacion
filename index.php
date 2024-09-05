<?php
// Definir la constante BASE_PATH con la ruta actual del directorio
define('BASE_PATH', __DIR__);

// Incluir el controlador WelcomeController
require BASE_PATH . '/db/database.php'; // Usa BASE_PATH para la ruta correcta

// Crear una instancia de la clase Database para obtener la conexión
$database = new Database();
$db = $database; // Esto asigna la instancia de la base de datos a la variable $db

//Inicializar variable de almacenamiento del controlador base
$controller = 'WelcomeController';
//Determinar Acciones a Tomar
if(!isset($_REQUEST['controller'])) {
    //Llamado a la clase controlador a usar
    require 'controllers/'.$controller.'.php';

    $controller = ucwords($controller);
    $controller = new $controller;
    $controller->index();
} else {
    //Cuando existe una solicitud desde el navegador
    $controller = ucwords($_REQUEST['controller']. 'Controller');
    //condicional ternario   condición           si es Verdad        si es Falso
    $method		= isset($_REQUEST['method']) ? $_REQUEST['method'] : 'index';

    require 'controllers/'.$controller.'.php';
    $controller = new $controller;

    //realizar el llamado o la ejecución del metodo en el controlador
    call_user_func(array($controller, $method));	

}