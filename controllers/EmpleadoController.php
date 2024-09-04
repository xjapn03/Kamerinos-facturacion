<?php
session_start();
require_once 'db/database.php';
require_once 'models/EmpleadoModel.php'; // Incluye el modelo Empleado

class EmpleadoController {
    private $model;

    public function __construct($db) {
        $this->model = new empleado($db);
    }

    public function index() {
        require_once 'views/Auth/login.php';
    }

    public function home() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            // Asegúrate de que la función de validación devuelva los datos correctos
            $user = $this->model->login($_POST['email'], $_POST['password']);
            if ($user) {
                // Configura las variables de sesión
                $_SESSION["id_empleado"] = $user['id_empleado'];
                $_SESSION["id_rol"] = $this->model->getRole($user['id_empleado']); // Asegúrate de que getRole devuelva el ID del rol
                $_SESSION["nombre_rol"] = $user['rol']; // Asegúrate de que 'rol' esté definido correctamente
                $_SESSION["nombre"] = $user['nombre'];
                $_SESSION["apellido"] = $user['apellido'];
                $_SESSION["telefono"] = $user['telefono'];
                $_SESSION["email"] = $user['email'];
                $_SESSION["OK"] = 1;

                require 'views/layout.php';
                require 'views/home.php';
            } else {
                // Manejo de error de login
                $_SESSION["id_empleado"] = 0;
                $_SESSION["OK"] = 0;

                require 'views/Auth/login.php';
            }
        } else {
            require '../views/Auth/login.php';
        }
    }

    public function inicio() {
        if (isset($_SESSION["OK"]) && $_SESSION["OK"] == 1) {
            require 'views/layout.php';
            require 'views/home.php';
        } else {
            require 'views/Auth/login.php';
        }
    }

    public function salir() {
        // Limpia las variables de sesión
        $_SESSION = array();
        session_destroy();

        require 'views/Auth/login.php';     
    }
}

// Maneja la acción de la URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index'; // Acción por defecto
}

$database = new Database();
$db = $database->getConnection();
$controller = new EmpleadoController($db);

// Ejecuta la acción correspondiente
switch ($action) {
    case 'home':
        $controller->home();
        break;
    case 'inicio':
        $controller->inicio();
        break;
    case 'salir':
        $controller->salir();
        break;
    default:
        $controller->index();
        break;
}
?>

