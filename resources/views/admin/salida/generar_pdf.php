<?php

require_once('tcpdf/tcpdf.php');

// Obtener los valores del formulario
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';

// Crear instancia de TCPDF
$pdf = new TCPDF();

// Agregar contenido al PDF
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Informe de Viaje', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Fecha de Salida: ' . $fecha_inicio, 0, 1);
$pdf->Cell(0, 10, 'Fecha de Retorno: ' . $fecha_fin, 0, 1);

// Salida del PDF
$pdf->Output('Informe_de_Viaje.pdf', 'D');
