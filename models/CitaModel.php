<?php
class CitaModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    // Obtener todas las citas y formatearlas para FullCalendar
    public function getAllCitas() {
        try {
            // Consulta SQL que une la tabla citas, clientes y servicios
            $strSql = "SELECT 
                            c.id_cita, 
                            c.abono, 
                            c.estado, 
                            c.fecha_cita, 
                            c.nota, 
                            cl.id_cliente,         -- ID del cliente
                            cl.nombre AS cliente_nombre, 
                            cl.apellido AS cliente_apellido, 
                            s.id_servicio,         -- Asegúrate de incluir el ID del servicio
                            s.nombre_servicio, 
                            cs.nombre AS categoria_nombre, 
                            e.id_empleado,         -- ID del empleado
                            e.nombre AS empleado_nombre 
                        FROM 
                            citas c 
                        JOIN 
                            clientes cl ON c.id_cliente = cl.id_cliente 
                        JOIN 
                            servicios s ON c.id_servicio = s.id_servicio 
                        JOIN 
                            categorias_servicios cs ON s.fk_categorias_servicios = cs.id_categoriaS 
                        JOIN 
                            empleados e ON c.id_empleado = e.id_empleado";

                                    
            // Ejecutar la consulta
            $citas = $this->pdo->query($strSql)->fetchAll(PDO::FETCH_ASSOC);
            $strSqlEnum = "SHOW COLUMNS FROM citas LIKE 'estado'";
            $enumResult = $this->pdo->query($strSqlEnum)->fetch(PDO::FETCH_ASSOC);
            
            // Extraer los valores de ENUM
            $type = $enumResult['Type']; // Ejemplo: "enum('agendada','completada','cancelada')"
            
            // Extraer los valores quitando la parte de "enum(" y ")" y separándolos en un array
            preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
            $enumValues = explode("','", $matches[1]); // Obtiene un array como ['agendada', 'completada', 'cancelada']

    
            // Formatear las citas para FullCalendar
            $eventos = [];
            foreach ($citas as $cita) {
                // Puedes asignar una clase CSS en función de algún criterio (por ejemplo, tipo de servicio)
                $className = ''; 
    
                // Lógica para asignar diferentes clases según el servicio
                switch ($cita['categoria_nombre']) {
                    case 'Manicura':
                        $className = 'bg-purple'; // Clase CSS para este servicio
                        break;
                    case 'Pedicura':
                        $className = 'bg-pink'; // Clase CSS para otro servicio
                        break;
                    default:
                        $className = 'bg-default'; // Clase por defecto
                        break;
                }   
    
                // Asignación de valores a eventos
                $eventos[] = [
                    'id' => $cita['id_cita'],
                    'title' => $cita['cliente_nombre'] . ' - ' . $cita['nombre_servicio'], // Mostrar nombre del cliente y servicio
                    'start' => $cita['fecha_cita'], // Asegúrate de que la fecha esté en formato ISO 8601
                    'description' => $cita['nota'],
                    'className' => $className, // Asignar la clase CSS
                    'estado' => $cita['estado'],
                    'abono' => $cita['abono'],
                    'empleado' => $cita['empleado_nombre'],
                    'servicio' => $cita['nombre_servicio'],
                    'id_servicio' => $cita['id_servicio'],
                    'id_empleado' => $cita['id_empleado'], // Ahora id_cliente estará disponible
                    'cliente' => $cita['cliente_nombre'] . ' ' . $cita['cliente_apellido'],
                    'id_cliente' => $cita['id_cliente'] // Ahora id_cliente estará disponible
                ];
            }
    
            return [
                'eventos' => $eventos,
                'estados' => $enumValues
            ];
    
        } catch (PDOException $e) {
            error_log($e->getMessage()); // Registrar el error en el log
            return []; // Devuelve un array vacío en caso de error
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
                        id_empleado = :id_empleado, 
                        fecha_cita = :fecha_cita, 
                        abono = :abono, 
                        estado = :estado, 
                        nota = :nota 
                        WHERE id_cita = :id_evento";
            
                // Preparar la sentencia SQL
                $stmt = $this->pdo->prepare($strSql);
                
                // Ejecutar la consulta con los datos recibidos
                $stmt->execute([
                    'id_servicio' => $data['servicio'], // Asegúrate de que aquí se recibe el ID del servicio
                    'id_cliente' => $data['cliente'], // Asegúrate de que aquí se recibe el ID del cliente
                    'id_empleado' => $data['empleado'], // Asegúrate de que aquí se recibe el ID del empleado
                    'fecha_cita' => $data['fecha_cita'], // Fecha y hora de la cita
                    'abono' => $data['abono'], // Abono realizado
                    'estado' => $data['estado'], // Estado de la cita (agendada, cancelada, etc.)
                    'nota' => $data['description'], // Nota o descripción de la cita
                    'id_evento' => $data['id_evento'] // ID de la cita/evento
                ]);

                return true; // Devuelve true si la actualización fue exitosa
            } catch (PDOException $e) {
                error_log($e->getMessage()); // Registrar el error en el log
                return false; // Devuelve false si hubo un error
            }
        }

        public function createCita($data) {
            try {
                $fechaCita = date('Y-m-d H:i:s', strtotime($data['fecha_cita']));
                // Consulta SQL para insertar una nueva cita
                $strSql = "INSERT INTO citas (id_servicio, id_cliente, id_empleado, fecha_cita, abono, estado, nota) 
                           VALUES (:id_servicio, :id_cliente, :id_empleado, :fecha_cita, :abono, :estado, :nota)";
                
                // Preparar la sentencia SQL
                $stmt = $this->pdo->prepare($strSql);
                
                // Ejecutar la consulta con los datos recibidos
                $stmt->execute([
                    'id_servicio' => $data['servicio'], // ID del servicio
                    'id_cliente' => $data['cliente'],   // ID del cliente
                    'id_empleado' => $data['empleado'], // ID del empleado
                    'fecha_cita' => $fechaCita, // Fecha y hora de la cita en el formato correcto
                    'abono' => $data['abono'],           // Abono realizado
                    'estado' => $data['estado'],         // Estado de la cita (agendada, completada, etc.)
                    'nota' => $data['description']       // Nota o descripción de la cita
                ]);
        
                return true; // Devuelve true si la inserción fue exitosa
            } catch (PDOException $e) {
                error_log($e->getMessage()); // Registrar el error en el log
                return false; // Devuelve false si hubo un error
            }
        }

        public function updateFecha($data) {
            try {
                $strSql = "UPDATE citas SET 
                            fecha_cita = :fecha_cita 
                            WHERE id_cita = :id_evento";
        
                // Preparar la sentencia SQL
                $stmt = $this->pdo->prepare($strSql);
        
                // Ejecutar la consulta con los datos recibidos
                $stmt->execute([
                    'fecha_cita' => $data['fecha_cita'], // Nueva fecha y hora de la cita
                    'id_evento' => $data['id_evento'] // ID de la cita/evento
                ]);
        
                return true; // Devuelve true si la actualización fue exitosa
            } catch (PDOException $e) {
                error_log($e->getMessage()); // Registrar el error en el log
                return false; // Devuelve false si hubo un error
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
