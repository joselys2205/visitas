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

	$pdf->Ln(10);


	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(85,8,'',0);
	$pdf->Cell(70,8,'Listado de Visitas',0);
	$pdf->Cell(15,8,'',0);



	$pdf->Ln(14);

	$pdf->Ln(10);


	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,8,'#',0);
	$pdf->Cell(25,8,'Nombre ',0);
	$pdf->Cell(45,8,'Apellido',0);
	$pdf->Cell(27,8,'Tipo de Visita',0);
	$pdf->Cell(25,8,'Fecha',0);
	$pdf->Cell(25,8,'Hora Ent',0);
	$pdf->Cell(25,8,'Trabajador',0);
	


	$pdf->Ln(8);

	/*$formulario_visitas=mysql_query("SELECT id_visi, ced_visi, nom_visi, ape_visi, tip_visi, corr_visi, tlf_visi, fec_visi, hor_ent, personal.ced_usu, des_visi, foto, nick_usu FROM visitas INNER JOIN usuario ON visitas.ide_usu = usuario.ide_usu INNER JOIN personal ON visitas.ide_per = personal.ide_per");*/
	$formulario_visitas=mysql_query("SELECT * FROM visitas");
	while ($consulta=mysql_fetch_array($formulario_visitas)){
										 
										

	$pdf->SetFont('Arial','',9);
	$pdf->Cell(10,8,$consulta['id_visi'],0);
	$pdf->Cell(25,8,$consulta['nom_visi'],0);
	$pdf->Cell(45,8,$consulta['ape_visi'],0);
	$pdf->Cell(27,8,$consulta['tip_visi'],0);
	$pdf->Cell(25,8,$consulta['fec_visi'],0);
	$pdf->Cell(25,8,$consulta['hor_ent'],0);
	$pdf->Cell(25,8,$consulta['ced_usu'],0);
	

	$pdf->Ln(6);
	}

	$pdf->Ln(30);







	$pdf->Output();


	?>