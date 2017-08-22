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

		//esto lo traigo del el documento visitas, es para traerme la cedula de esa persona

		$visitas = $_GET['id'];

		$pdf=new FPDF();
		$pdf->Addpage();
		$pdf->SetFont('Arial','',14);
		
		$pdf->image('../img/cintillo2.jpg', 20,10,165,20,'JPG');
		$pdf->Ln(25);
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
		$pdf->Cell(70,8,'',0);
		$pdf->Cell(70,8,'Datos Generales de la Visita',0);
		$pdf->Cell(15,8,'',0);

		

		//esta consulta esta bien, solo tengo que verificar que la variable con las que llamo a cada selda sea la correcta


	//CONSULTA
		$datos_visi=mysql_query("SELECT * from visitas where id_visi='$visitas' ");
		if ($datos=mysql_fetch_array($datos_visi)) {

			$cedula_personal_visitas = $datos["ced_usu"];
			$cedula_visitas = $datos["ced_visi"];
			$consulta_visitas=mysql_query("SELECT ced_usu,nom_per,ape_per FROM personal WHERE ced_usu='$cedula_personal_visitas'");
											if ($datos_personal=mysql_fetch_array($consulta_visitas)) {
												$nombre_personal=$datos_personal['nom_per'];
												$apellido_personal=$datos_personal['ape_per'];
							}	//FINALIZACION DEL FETCH ARRAY...		
			$personal1 = $nombre_personal.' '.$apellido_personal;

	
}//FINALIZACION DEL IF...

		$pdf->Ln(25);
		$pdf->SetFont('Arial','',9);

		$pdf->Cell(60,8,'Cedula: '.$datos['ced_visi'],0);
		$pdf->Cell(60,8,'Nombre: '.$datos['nom_visi'],0);
		$pdf->Cell(60,8,'Apellido: '.$datos['ape_visi'],0);
		

		$pdf->Ln(14);
		$pdf->SetFont('Arial','',9);

		$pdf->Cell(60,8,'Fecha: '.$datos['fec_visi'],0);
		$pdf->Cell(60,8,'Hora Entrada: '.$datos['hor_ent'],0);
		$pdf->Cell(0,8,'Hora Salida: '.$datos['hor_sal'],0);
		

		$pdf->Ln(14);
		$pdf->SetFont('Arial','',9);

		$pdf->Cell(120,8,'Trabajador Visitado: '.$personal1,0);
		$pdf->Cell(80,8,'Tipo de Visita: '.$datos['tip_visi'],0);

		$pdf->Ln(14);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,8,'Descripcion: '.$datos['des_visi'],0);
		



		$pdf->Output();


		?>