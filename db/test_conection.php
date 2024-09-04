<?php
require_once 'database.php'; // Incluye la clase Database

// Crea una instancia de la clase Database
$database = new Database();

// Llama al método getConnection() para intentar conectarse a la base de datos
$connection = $database->getConnection();

// Verifica si la conexión fue exitosa
if ($connection) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar a la base de datos.";
}
?>
