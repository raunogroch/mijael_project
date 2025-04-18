<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/views/fpdf/fpdf.php';
class PDF extends FPDF
{
    private $conn; // Propiedad para almacenar la conexión
    
    // Constructor que recibe la conexión
    function __construct($connection) {
        parent::__construct();
        $this->conn = $connection;
    }
    
    // Cabecera de página
    function Header()
    {
        // Usar $this->conn en lugar de $conn
        $consulta_info = $this->conn->query("SELECT * FROM instituto");
        $dato_info = $consulta_info->fetch_object();
        
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/views/fpdf/logo.jpg', 160, 5, 20);
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(40);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 15, utf8_decode($dato_info->nombre), 0, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        /* Resto del código del Header... */
    }

    // Pie de página (sin cambios)
    function Footer()
    {
        // ... (código existente)
    }
}

// Conexión a la base de datos
require_once $_SERVER['DOCUMENT_ROOT'].'/model/conexion.php';

// Crear PDF pasando la conexión
$pdf = new PDF($conn);  // ✅ Pasamos $conn al constructor
$pdf->AddPage("");
$pdf->AliasNbPages();

// Generar contenido del PDF
$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

$consulta_reporte_usuario = $conn->query("SELECT * FROM cargo");
while ($datos_reporte = $consulta_reporte_usuario->fetch_object()) {
    $i++;
    $pdf->Cell(25, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(165, 10, utf8_decode($datos_reporte->nombre), 1, 1, 'C', 0);
}

$pdf->Output('Reporte AREAS.pdf', 'I');