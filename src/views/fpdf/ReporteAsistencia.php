<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/views/fpdf/fpdf.php';

class PDF extends FPDF
{
    private $conn; // Add a property to store the connection
    
    // Add a constructor to accept the connection
    function __construct($connection) {
        parent::__construct();
        $this->conn = $connection;
    }

    // Cabecera de página
    function Header()
    {
        $consulta_info = $this->conn->query(" select * from instituto "); // Use $this->conn instead of $conn
        $dato_info = $consulta_info->fetch_object();
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/views/fpdf/logo.jpg', 270, 5, 20);
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(95);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 15, utf8_decode($dato_info->nombre), 0, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        /* UBICACION */
        $this->Cell(180);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
        $this->Ln(5);

        /* TELEFONO */
        $this->Cell(180);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Teléfono : " . $dato_info->telefono), 0, 0, '', 0);
        $this->Ln(5);

        /* NIT */
        $this->Cell(180);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("NIT : " . $dato_info->NIT), 0, 0, '', 0);
        $this->Ln(10);

        /* TITULO DE LA TABLA */
        $this->SetTextColor(0, 95, 189);
        $this->Cell(100);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS "), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        $this->SetFillColor(125, 173, 221);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
        $this->Cell(80, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('CI'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('SALIDA'), 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C');
    }
}

require_once $_SERVER['DOCUMENT_ROOT'].'/model/conexion.php';

// Create the PDF instance and pass the connection
$pdf = new PDF($conn);
$pdf->AddPage("landscape");
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

$consulta_reporte_asistencia = $conn->query(" select asistencia.entrada,asistencia.salida,empleado.nombre,empleado.apellido,empleado.CI,cargo.nombre as 'nomCargo' from asistencia
inner join empleado ON asistencia.id_empleado=empleado.id_empleado
inner join cargo ON empleado.cargo=cargo.id_cargo ");

while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {
    $i = $i + 1;
    $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(80, 10, utf8_decode($datos_reporte->nombre ." ".$datos_reporte->apellido), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($datos_reporte->CI), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->nomCargo), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->entrada), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->salida), 1, 1, 'C', 0);
}

$pdf->Output('Reporte Asistencia.pdf', 'I');