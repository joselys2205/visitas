<?php
require("libreria/fpdf.php");
//include("../../conexion.php");


$pdf=new FPDF();
$pdf->Addpage();
$pdf->SetFont('Arial','',14);
$pdf->image('../img/logo-funrevi.png', 3,0,55,17,'PNG');
$pdf->image('../img/cintillo.jpg', 100,5,100,10,'JPG');


$pdf->Ln(20);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(70,8,'',0);
$pdf->Cell(70,8,'Notas de Entregas',0);
$pdf->Cell(15,8,'',0);
$pdf->Cell(20,8,'Nro:',0);

$pdf->Ln(12);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,8,'Datos Del Beneficiario',0);

$pdf->Ln(7);

$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,8,'Nombre:',0);
$pdf->Cell(70,8,'Apellido:',0);
$pdf->Cell(70,8,'Cedula:',0);


$pdf->Ln(7);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,8,'Municipio:',0);
$pdf->Cell(70,8,'Parroquia:',0);
$pdf->Cell(30,8,'Proyecto:',0);

$pdf->Ln(7);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(70,8,'Telefono:',0);
$pdf->Cell(70,8,'Inspector:',0);
$pdf->Cell(70,8,'Fase:',0);

$pdf->Ln(14);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70,8,'',0);
$pdf->Cell(50,8,'Materiales',0);
$pdf->Ln(14);


//consulta a la base de dato
/*
$formulario_beneficiario=mysql_query("SELECT * FROM beneficiario");
$item=0;
while ($consulta=mysql_fetch_array($formulario_beneficiario)){
$item=$item+1;

$pdf->Cell(70,8,$item,0);
$pdf->Cell(70,8,$consulta['nom_ben'],0);
$pdf->Cell(70,8,$consulta['ced_ben'],0);
$pdf->Cell(70,8,$consulta['mun_ben'],0);
$pdf->Cell(70,8,$consulta['par_ben'],0);

$pdf->Cell(30,8,$consulta[' ojo proyecto'],0);

$pdf->Cell(70,8,$consulta['tel_ben'],0);

$pdf->Cell(70,8,$consulta['ojo inspector'],0);

$pdf->Cell(70,8,$consulta['ojo fase'],0);



}*/


$pdf->Output();


?>