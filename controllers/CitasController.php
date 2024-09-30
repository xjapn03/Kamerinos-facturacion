<?php
session_start();
require 'models/CitaModel.php';

class CitasController {
    private $citaModel;

    public function __construct($db) {
        $this->citaModel = new CitaModel($db); // Corrige el nombre del modelo a CitaModel
    }

    public function index() {
        require 'views/layout.php';
        require 'views/Citas/list.php';
    }

    // Obtener todas las citas y devolverlas en formato JSON
    public function getAll() {
        header('Content-Type: application/json'); // Asegúrate de que la respuesta tenga el encabezado correcto
        $citas = $this->citaModel->getAllCitas();
        echo json_encode($citas); // Devuelve las citas en formato JSON
        exit; // Finaliza el script para evitar cargar otras vistas o contenido
    }

    

    // Guardar una nueva cita
    public function create() {
        $data = $_POST; // Recoge los datos enviados por AJAX
        $this->citaModel->createCita($data);
        echo json_encode(['success' => true]);
    }



    // Actualizar una cita existente
    public function update() {
        $data = $_POST; 
        $this->citaModel->updateCita($data); // Cambia el método a updateCita
        echo json_encode(['success' => true]);
    }

    public function updateFecha() {
        $data = $_POST; 
        $this->citaModel->updateFecha($data); // Cambia el método a updateCita
        echo json_encode(['success' => true]);
    }
    // Eliminar una cita
    public function delete() {
        $id = $_POST['id_cita'];
        $this->citaModel->deleteCita($id);
        echo json_encode(['success' => true]);
    }

    // Obtener una cita específica por ID (para edición)
    public function edit() {
        $id = $_POST['id_cita'];
        $cita = $this->citaModel->getCitaById($id); // Utiliza el método getCitaById
        echo json_encode($cita);
    }
}
?>
