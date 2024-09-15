<?php
session_start();
require_once 'vendor/autoload.php';  // Autoload de Composer para usar mPDF
require_once 'models/VentasModel.php';  // Incluir el modelo de Ventas

class VentasReporteController {
    private $db;

    public function __construct($db) {
        $this->db = $db;  // Recibir la conexión de base de datos
    }

    public function generarPDF() {
        // Instancia del modelo para obtener datos
        $ventaModel = new VentaModel($this->db);
        $ventas = $ventaModel->getVentasDelDia();  // Obtener ventas del día

        // Cargar la vista en HTML
        ob_start();
        include 'views/VentasReporte/list.php';  // Vista que contiene el HTML
        $html = ob_get_clean();

        // Crear una instancia de mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Escribir el HTML en el PDF
        $mpdf->WriteHTML($html);

        // Descargar el PDF generado
        $mpdf->Output('reporte_ventas.pdf', 'D');  // 'D' para descarga directa
    }
}
