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
        $consulta_info = $this->conn->query("SELECT * FROM instituto"); // Usar $this->conn
        $dato_info = $consulta_info->fetch_object();
        
        // Verificar si el logo existe
        $logoPath = 'logo.jpg';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, 160, 5, 20);
        }
        
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(40);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 15, utf8_decode($dato_info->nombre), 0, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        /* UBICACION */
        $this->Cell(130);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
        $this->Ln(5);

        /* TELEFONO */
        $this->Cell(130);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Teléfono : " . $dato_info->telefono), 0, 0, '', 0);
        $this->Ln(5);

        /* NIT */
        $this->Cell(130);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("NIT : " . $dato_info->NIT), 0, 0, '', 0);
        $this->Ln(10);

        /* TITULO DE LA TABLA */
        $this->SetTextColor(0, 95, 189);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE USUARIOS"), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        $this->SetFillColor(125, 173, 221);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
        $this->Cell(62, 10, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
        $this->Cell(62, 10, utf8_decode('APELLIDO'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('USUARIO'), 1, 1, 'C', 1);
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

// Crear instancia de PDF pasando la conexión
$pdf = new PDF($conn);
$pdf->AddPage(""); // Página en vertical (portrait)
$pdf->AliasNbPages();

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163);

$consulta_reporte_usuario = $conn->query("SELECT * FROM usuario");

while ($datos_reporte = $consulta_reporte_usuario->fetch_object()) {
    $i = $i + 1;
    $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(62, 10, utf8_decode($datos_reporte->nombre), 1, 0, 'C', 0);
    $pdf->Cell(62, 10, utf8_decode($datos_reporte->apellido), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->usuario), 1, 1, 'C', 0);
}

$pdf->Output('Reporte usuario.pdf', 'I');