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
        $consulta_info = $this->conn->query(" select * from instituto "); //traemos datos del instituto desde BD
        $dato_info = $consulta_info->fetch_object();
        $this->Image($_SERVER['DOCUMENT_ROOT'].'/views/fpdf/logo.jpg', 160, 5, 20); //logo,moverDerecha,moverAbajo,tamañoIMG
        $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(40); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); //color
        //creamos una celda o fila
        $this->Cell(110, 15, utf8_decode($dato_info->nombre), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
        $this->Ln(3); // Salto de línea
        $this->SetTextColor(103); //color

        /* UBICACION */
        $this->Cell(130);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
        $this->Ln(5);

        /* TELEFONO */
        $this->Cell(130);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(59, 10, utf8_decode("Teléfono : " . $dato_info->telefono), 0, 0, '', 0);
        $this->Ln(5);

        /* NIT */
        $this->Cell(130);  // mover a la derecha
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(85, 10, utf8_decode("NIT : " . $dato_info->NIT), 0, 0, '', 0);
        $this->Ln(10);

        /* TITULO DE LA TABLA */
        //color
        $this->SetTextColor(0, 95, 189);
        $this->Cell(50); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DEL PERSONAL "), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        //color
        $this->SetFillColor(125, 173, 221); //colorFondo
        $this->SetTextColor(0, 0, 0); //colorTexto
        $this->SetDrawColor(163, 163, 163); //colorBorde
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
        $this->Cell(62, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
        $this->Cell(62, 10, utf8_decode('CI'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('CARGO'), 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }
}

require_once $_SERVER['DOCUMENT_ROOT'].'/model/conexion.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */

// Pass the connection to the PDF constructor
$pdf = new PDF($conn);
$pdf->AddPage(""); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_empleado = $conn->query(" select empleado.nombre, empleado.apellido, empleado.CI, cargo.nombre as 'nomCargo' from empleado inner join cargo ON cargo.id_cargo=empleado.cargo");

while ($datos_reporte = $consulta_reporte_empleado->fetch_object()) {
    $i = $i + 1;
    /* TABLA */
    $pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
    $pdf->Cell(62, 10, utf8_decode($datos_reporte->nombre ." ". $datos_reporte->apellido), 1, 0, 'C', 0);
    $pdf->Cell(62, 10, utf8_decode($datos_reporte->CI), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($datos_reporte->nomCargo), 1, 1, 'C', 0);
}

$pdf->Output('Reporte personal.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)