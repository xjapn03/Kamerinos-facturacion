<?php

class VentaModel {
    private $pdo;

    public function __construct($db) {
        $this->pdo = $db;
    }

    // Método para obtener todas las ventas
    public function getAll() {
        try {
            $sql = "SELECT v.*, c.nombre AS nombre_cliente, e.nombre AS nombre_empleado 
                    FROM ventas v 
                    INNER JOIN clientes c ON v.id_cliente = c.id_cliente
                    INNER JOIN empleados e ON v.id_empleado = e.id_empleado";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para obtener una venta por ID
    public function getById($id) {
        try {
            $strSql = "SELECT * FROM ventas WHERE id_venta = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar una nueva venta
    public function newVenta($data) {   
        try {
            $sql = "INSERT INTO ventas (id_cliente, id_empleado, id_promocion, fecha_generacion, monto_total) 
                    VALUES (:id_cliente, :id_empleado, :id_promocion, NOW(), :monto_total)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_cliente' => $data['id_cliente'],
                'id_empleado' => $data['id_empleado'],
                'id_promocion' => $data['id_promocion'],
                'monto_total' => $data['monto_total']
            ]);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para editar una venta
    public function editVenta($data) {
        try {      
            $strSql = "UPDATE ventas SET id_cliente = :id_cliente, id_empleado = :id_empleado, 
                        id_promocion = :id_promocion, monto_total = :monto_total
                        WHERE id_venta = :id_venta";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute([
                'id_cliente' => $data['id_cliente'],
                'id_empleado' => $data['id_empleado'],
                'id_promocion' => $data['id_promocion'],
                'monto_total' => $data['monto_total'],
                'id_venta' => $data['id_venta']
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }

    // Método para eliminar una venta
    public function deleteVenta($id) {
        try {
            $strSql = "DELETE FROM ventas WHERE id_venta = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }

    // Método para obtener las ventas del día
    public function getVentasDelDia() {
        try {
            $sql = "SELECT v.*, c.nombre AS nombre_cliente, e.nombre AS nombre_empleado 
                    FROM ventas v
                    INNER JOIN clientes c ON v.id_cliente = c.id_cliente
                    INNER JOIN empleados e ON v.id_empleado = e.id_empleado
                    WHERE DATE(v.fecha_generacion) = CURDATE()";  // Filtrar ventas por la fecha actual
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}
?>
