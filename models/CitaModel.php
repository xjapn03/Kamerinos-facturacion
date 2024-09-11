<?php
class CitaModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    // Obtener todas las citas y formatearlas para FullCalendar
    public function getAllCitas() {
        try {
            $strSql = "SELECT * FROM citas";
            $citas = $this->pdo->query($strSql)->fetchAll(PDO::FETCH_ASSOC);

            // Formatear las citas para FullCalendar
            $eventos = [];
            foreach ($citas as $cita) {
                $eventos[] = [
                    'id' => $cita['id_cita'],
                    'title' => 'Cita con ' . $cita['id_cliente'], // Ajustar el título según tus necesidades
                    'start' => $cita['fecha_cita'], // Asegúrate de que la fecha esté en formato ISO 8601
                    'description' => $cita['nota'],
                    // Puedes agregar más campos según tus necesidades
                ];
            }

            return $eventos; // Devuelve los eventos formateados

        } catch (PDOException $e) {
            error_log($e->getMessage()); // Registrar el error en el log
            return []; // Devuelve un array vacío en caso de error
        }
    }

    // Crear una nueva cita
    public function createCita($data) {
        try {
            $strSql = "INSERT INTO citas (id_servicio, id_cliente, id_promocion, id_empleado, fecha_cita, abono, estado, nota) 
                       VALUES (:id_servicio, :id_cliente, :id_promocion, :id_empleado, :fecha_cita, :abono, :estado, :nota)";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute([
                'id_servicio' => $data['id_servicio'],
                'id_cliente' => $data['id_cliente'],
                'id_promocion' => $data['id_promocion'],
                'id_empleado' => $data['id_empleado'],
                'fecha_cita' => $data['fecha_cita'],
                'abono' => $data['abono'],
                'estado' => $data['estado'],
                'nota' => $data['nota']
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Registrar el error en el log
            return false; // Indicar que hubo un error
        }
    }

    // Obtener una cita por su ID
    public function getCitaById($id) {
        try {
            $strSql = "SELECT * FROM citas WHERE id_cita = :id_cita";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_cita' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return null; // Devuelve null en caso de error
        }
    }

    // Actualizar una cita existente
    public function updateCita($data) {
        try {
            $strSql = "UPDATE citas SET 
                       id_servicio = :id_servicio, 
                       id_cliente = :id_cliente, 
                       id_promocion = :id_promocion, 
                       id_empleado = :id_empleado, 
                       fecha_cita = :fecha_cita, 
                       abono = :abono, 
                       estado = :estado, 
                       nota = :nota 
                       WHERE id_cita = :id_cita";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute([
                'id_servicio' => $data['id_servicio'],
                'id_cliente' => $data['id_cliente'],
                'id_promocion' => $data['id_promocion'],
                'id_empleado' => $data['id_empleado'],
                'fecha_cita' => $data['fecha_cita'],
                'abono' => $data['abono'],
                'estado' => $data['estado'],
                'nota' => $data['nota'],
                'id_cita' => $data['id_cita']
            ]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Eliminar una cita
    public function deleteCita($id) {
        try {
            $strSql = "DELETE FROM citas WHERE id_cita = :id_cita";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id_cita' => $id]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
