<?php
// Definir la constante BASE_PATH con la ruta actual del directorio
define('BASE_PATH', __DIR__);

// Incluir el archivo de la clase Database
require BASE_PATH . '/db/database.php';

// Crear una instancia de la clase Database para obtener la conexión
$db = new Database(); // Instanciar directamente la clase Database

// Inicializar variable de almacenamiento del controlador base
$controller = 'WelcomeController';

// Determinar Acciones a Tomar
if (!isset($_REQUEST['controller'])) {
    // Llamado a la clase controlador a usar
    require 'controllers/' . $controller . '.php';

    $controller = ucwords($controller);
    $controller = new $controller($db); // Pasar la conexión de la base de datos
    $controller->index();
} else {
    // Cuando existe una solicitud desde el navegador
    $controller = ucwords($_REQUEST['controller'] . 'Controller');
    $method = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'index';

    require 'controllers/' . $controller . '.php';
    $controller = new $controller($db); // Pasar la conexión de la base de datos

    // Realizar el llamado o la ejecución del método en el controlador
    call_user_func(array($controller, $method));
}
?>
