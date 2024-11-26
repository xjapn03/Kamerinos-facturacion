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
            // Obtener la venta principal
            $strSql = "SELECT * FROM ventas WHERE id_venta = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
            $venta = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Obtener los detalles de productos
            $strSqlProductos = "SELECT p.nombre AS producto, vd.cantidad, vd.precio, vd.ganancia 
                                FROM venta_detalle vd 
                                INNER JOIN productos p ON vd.id_producto = p.id_producto
                                WHERE vd.id_venta = :id";
            $stmtProductos = $this->pdo->prepare($strSqlProductos);
            $stmtProductos->execute(['id' => $id]);
            $productos = $stmtProductos->fetchAll(PDO::FETCH_ASSOC);
    
            // Obtener los detalles de servicios
            $strSqlServicios = "SELECT s.nombre AS servicio, vd.cantidad, vd.precio, vd.ganancia 
                                FROM venta_detalle vd 
                                INNER JOIN servicios s ON vd.id_servicio = s.id_servicio
                                WHERE vd.id_venta = :id";
            $stmtServicios = $this->pdo->prepare($strSqlServicios);
            $stmtServicios->execute(['id' => $id]);
            $servicios = $stmtServicios->fetchAll(PDO::FETCH_ASSOC);
    
            return [
                'venta' => $venta,
                'productos' => $productos,
                'servicios' => $servicios
            ];
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    

    // Método para registrar una nueva venta
    public function newVenta($data, $productos, $servicios) {   
        try {
            // Insertar la venta
            $sql = "INSERT INTO ventas (id_cliente, id_empleado, fecha_hora, total, total_empleado, ganancia_total) 
                    VALUES (:id_cliente, :id_empleado, NOW(), :total, :total_empleado, :ganancia_total)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_cliente' => $data['id_cliente'],
                'id_empleado' => $data['id_empleado'],
                'total' => $data['total'],
                'total_empleado' => $data['total_empleado'],
                'ganancia_total' => $data['ganancia_total']
            ]);
            
            $idVenta = $this->pdo->lastInsertId();
    
            // Insertar productos y calcular ganancias
            foreach ($productos as $producto) {
                $sqlProducto = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad, precio, ganancia) 
                                VALUES (:id_venta, :id_producto, :cantidad, :precio, :ganancia)";
                $stmtProducto = $this->pdo->prepare($sqlProducto);
                $gananciaProducto = $producto['precio'] * $producto['cantidad'] * ($producto['porcentaje_comision'] / 100);
                $stmtProducto->execute([
                    'id_venta' => $idVenta,
                    'id_producto' => $producto['id_producto'],
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['precio'],
                    'ganancia' => $gananciaProducto
                ]);
            }
    
            // Insertar servicios y calcular ganancias
            foreach ($servicios as $servicio) {
                $sqlServicio = "INSERT INTO venta_detalle (id_venta, id_servicio, cantidad, precio, ganancia) 
                                VALUES (:id_venta, :id_servicio, :cantidad, :precio, :ganancia)";
                $stmtServicio = $this->pdo->prepare($sqlServicio);
                $gananciaServicio = $servicio['precio'] * $servicio['cantidad'] * ($servicio['porcentaje_comision'] / 100);
                $stmtServicio->execute([
                    'id_venta' => $idVenta,
                    'id_servicio' => $servicio['id_servicio'],
                    'cantidad' => $servicio['cantidad'],
                    'precio' => $servicio['precio'],
                    'ganancia' => $gananciaServicio
                ]);
            }
    
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    

    // Método para editar una venta
    public function editVenta($data, $productos, $servicios) {
        try {
            $strSql = "UPDATE ventas SET id_cliente = :id_cliente, id_empleado = :id_empleado, 
                        fecha_hora = NOW(), total = :total, total_empleado = :total_empleado, ganancia_total = :ganancia_total 
                        WHERE id_venta = :id_venta";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute([
                'id_cliente' => $data['id_cliente'],
                'id_empleado' => $data['id_empleado'],
                'total' => $data['total'],
                'total_empleado' => $data['total_empleado'],
                'ganancia_total' => $data['ganancia_total'],
                'id_venta' => $data['id_venta']
            ]);
    
            // Eliminar los detalles anteriores de productos y servicios
            $sqlDelete = "DELETE FROM venta_detalle WHERE id_venta = :id_venta";
            $stmtDelete = $this->pdo->prepare($sqlDelete);
            $stmtDelete->execute(['id_venta' => $data['id_venta']]);
    
            // Insertar nuevos productos
            foreach ($productos as $producto) {
                $sqlProducto = "INSERT INTO venta_detalle (id_venta, id_producto, cantidad, precio, ganancia) 
                                VALUES (:id_venta, :id_producto, :cantidad, :precio, :ganancia)";
                $stmtProducto = $this->pdo->prepare($sqlProducto);
                $gananciaProducto = $producto['precio'] * $producto['cantidad'] * ($producto['porcentaje_comision'] / 100);
                $stmtProducto->execute([
                    'id_venta' => $data['id_venta'],
                    'id_producto' => $producto['id_producto'],
                    'cantidad' => $producto['cantidad'],
                    'precio' => $producto['precio'],
                    'ganancia' => $gananciaProducto
                ]);
            }
    
            // Insertar nuevos servicios
            foreach ($servicios as $servicio) {
                $sqlServicio = "INSERT INTO venta_detalle (id_venta, id_servicio, cantidad, precio, ganancia) 
                                VALUES (:id_venta, :id_servicio, :cantidad, :precio, :ganancia)";
                $stmtServicio = $this->pdo->prepare($sqlServicio);
                $gananciaServicio = $servicio['precio'] * $servicio['cantidad'] * ($servicio['porcentaje_comision'] / 100);
                $stmtServicio->execute([
                    'id_venta' => $data['id_venta'],
                    'id_servicio' => $servicio['id_servicio'],
                    'cantidad' => $servicio['cantidad'],
                    'precio' => $servicio['precio'],
                    'ganancia' => $gananciaServicio
                ]);
            }
    
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
