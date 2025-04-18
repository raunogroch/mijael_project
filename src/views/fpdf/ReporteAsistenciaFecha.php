<?php

if (!empty($_GET['txtfechadeinicio']) && !empty($_GET['txtfechadefinal']) && !empty($_GET['txtempleado'])) {
    $fechaInicio = $_GET['txtfechadeinicio'];
    $fechaFinal = $_GET['txtfechadefinal'];
    $empleado = $_GET['txtempleado'];
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/fpdf/fpdf.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/model/conexion.php'; // Mover esta línea aquí

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
            $consulta_info = $this->conn->query("SELECT * FROM instituto");
            $dato_info = $consulta_info->fetch_object();
            
            // Verifica si el archivo de logo existe
            $logoPath = $_SERVER['DOCUMENT_ROOT'].'/views/fpdf/logo.jpg';
            if (file_exists($logoPath)) {
                $this->Image($logoPath, 270, 5, 20);
            }
            
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
            $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS POR FECHAS "), 0, 1, 'C', 0);
            $this->Ln(7);

            /* CAMPOS DE LA TABLA */
            $this->SetFillColor(125, 173, 221);
            $this->SetTextColor(0, 0, 0);
            $this->SetDrawColor(163, 163, 163);
            $this->SetFont('Arial', 'B', 11);
            $this->Cell(10, 10, utf8_decode('N°'), 1, 0, 'C', 1);
            $this->Cell(62, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
            $this->Cell(25, 10, utf8_decode('CI'), 1, 0, 'C', 1);
            $this->Cell(27, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
            $this->Cell(50, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
            $this->Cell(50, 10, utf8_decode('SALIDA'), 1, 0, 'C', 1);
            $this->Cell(40, 10, utf8_decode('HORAS'), 1, 1, 'C', 1);
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

    // Crear instancia de PDF pasando la conexión
    $pdf = new PDF($conn);
    $pdf->AddPage("landscape");
    $pdf->AliasNbPages();

    $i = 0;
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetDrawColor(163, 163, 163);

    if ($empleado == "todos") {
        $sql = $conn->query("SELECT 
                                asistencia.id_asistencia,
                                asistencia.id_empleado,
                                date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada',
                                date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
                                TIMEDIFF(asistencia.salida, asistencia.entrada) as 'totalHR',
                                empleado.nombre,
                                empleado.apellido,
                                empleado.CI,
                                cargo.nombre as 'cargo'
                            FROM
                                asistencia
                            INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
                            INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
                            WHERE entrada BETWEEN '$fechaInicio' AND '$fechaFinal'
                            ORDER BY id_empleado ASC");
    } else {
        $sql = $conn->query("SELECT 
                                asistencia.id_asistencia,
                                asistencia.id_empleado,
                                date_format(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as 'entrada',
                                date_format(asistencia.salida, '%m-%d-%Y %H:%i:%s') as 'salida',
                                TIMEDIFF(asistencia.salida, asistencia.entrada) as 'totalHR',
                                empleado.nombre,
                                empleado.apellido,
                                empleado.CI,
                                cargo.nombre as 'cargo'
                            FROM
                                asistencia
                            INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado
                            INNER JOIN cargo ON empleado.cargo = cargo.id_cargo
                            WHERE asistencia.id_empleado = '$empleado' AND entrada BETWEEN '$fechaInicio' AND '$fechaFinal'
                            ORDER BY id_empleado ASC");
    }

    while ($datos_reporte = $sql->fetch_object()) {
        $i = $i + 1;
        $pdf->Cell(10, 10, utf8_decode($i), 1, 0, 'C', 0);
        $pdf->Cell(62, 10, utf8_decode($datos_reporte->nombre ." ".$datos_reporte->apellido), 1, 0, 'C', 0);
        $pdf->Cell(25, 10, utf8_decode($datos_reporte->CI), 1, 0, 'C', 0);
        $pdf->Cell(27, 10, utf8_decode($datos_reporte->cargo), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode($datos_reporte->entrada), 1, 0, 'C', 0);
        $pdf->Cell(50, 10, utf8_decode($datos_reporte->salida), 1, 0, 'C', 0);
        $pdf->Cell(40, 10, utf8_decode($datos_reporte->totalHR), 1, 1, 'C', 0);
    }

    $pdf->Output('Reporte por fechas.pdf', 'I');
}