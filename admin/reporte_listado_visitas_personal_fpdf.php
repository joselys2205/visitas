<?php
session_start();
require("../fpdf/libreria/fpdf.php");
include("../conexion.php");
if ($_SESSION['tipo']=="admin") {
	$cedula=$_SESSION['cedula'];
	$consultardato=mysql_query("SELECT * FROM usuario WHERE ced_usu='$cedula'");
	if ($dato=mysql_fetch_array($consultardato)) {
		$nombree=$dato['nom_usu'];
		$apellidoo=$dato['ape_usu'];
		$cedula_usuario=$dato['ced_usu'];
	}
	$nombre_usuario = $nombree.' '.$apellidoo;

}
else{
		header('location:../index.php');

}

$pdf=new FPDF();
	$pdf->Addpage();
	$pdf->SetFont('Arial','',14);
			
			$pdf->image('../img/CINTILLO_1.png', 20,10,165,20,'PNG');
			$pdf->Ln(30);
			$pdf->SetFont('Arial','B',11);
			$pdf->Cell(85,8,'',0);
			$pdf->Cell(70,8,'REPORTES',0);

			$pdf->Ln(12);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(70,8,'',0);
	$pdf->Cell(90,8,'',0);
	$pdf->Cell(30, 7, 'Fecha: '.date("Y-m-d").'', 0);

	$pdf->Ln(5);
	$pdf->Cell(70,8,'',0);
	$pdf->Cell(70,8,'',0);
	$pdf->Cell(20,8,'',0);
	$pdf->Cell(30, 7, 'Hora: '.date("H:i:s").'', 0);

	pdf->Ln(10);
$datos_personal=mysql_query("SELECT * FROM personal ");
while ($consulta=mysql_fetch_array($datos_personal)) {
	
}


$pdf->SetFont('Arial','B',9);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,8,'Nombre: '.$consulta['nom_per'],0);
$pdf->Cell(70,8,'Apellido: '.$consulta['ape_per'],0);
$pdf->Cell(70,8,'Cedula: '.$consulta['ced_usu'],0);

$pdf->Ln(14);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,8,'Gerencia: '.$consulta[''],0);
$pdf->Cell(70,8,'Coordinacion: '.$consulta[''],0);
$pdf->Cell(70,8,'Cargo: '.$consulta[''],0);
}

$pdf->Ln(14);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,8,'',0);
$pdf->Cell(50,8,'Visitas Realizadas',0);
$pdf->Ln(15);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,8,'#',0);
$pdf->Cell(30,8,'Nombre ',0);
$pdf->Cell(30,8,'Apellido',0);
$pdf->Cell(20,8,'Fecha',0);
$pdf->Cell(30,8,'Hora Entrada',0);
$pdf->Cell(30,8,'Hora Salida',0);
$pdf->Cell(40,8,'Usuario',0);

$pdf->Ln(8);





$pdf->Output();


?>