	<?php

	session_start();
	include_once('../conexion.php');
	if ($_SESSION['tipo']=="admin") {
		$cedula=$_SESSION['cedula'];
		$consultardato=mysql_query("SELECT * FROM usuario WHERE ced_usu='$cedula'");
		if ($dato=mysql_fetch_array($consultardato)) {
			$nombre=$dato['nom_usu'];
			$apellido=$dato['ape_usu'];
			$tipo=$dato['ced_usu'];
		}

	}
	else{
			header('location:../index.php');

	}
	$usuario=$_SESSION['usuario'];
	$time=time();
	$fecha=date("d/m/Y", $time);
	$hora=date("H:i:s", $time);

	mysql_query("INSERT INTO historial (ide_historial,usuario,evento,fecha,hora) 
		VALUES ('','$usuario','Módulo Inicio','$fecha','$hora')");
	$menuinicio="active";
	?>
	<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- Apple devices fullscreen -->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<!-- Apple devices fullscreen -->
		<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		
		<title>Seguridad (ANTV)</title>
		<?php
		include("head.php");
		?>	
	</head>

	<body>
		<?php
		include('navegacion.php');
		?>
		<br>
			<div class="container">
				<div class="col-md-offset-2">
					<h1 class="bienvenido"><font face="Comic Sans MS,Arial,Verdana"><b>Bienvenido</b></font></h1>		<br><br>			
					<div class="breadcrumbs">
						<ul class="list-unstyled">
							<li class="margen-0">
								<a class="sub-fonts" href="#"><font size="4" face="Comic Sans MS,Arial,Verdana"><b>Sistema de Seguridad (ANTV) </b></font></a>
								
								
							</li>
						</ul>			
					</div>

					
								

					<div class="span6">
						<div class="box">
							<div class="box-title">
								<h3><i class="icon-calendar"></i>Mi calendario</h3>
							</div>
							<div class="box-content nopadding">
								<div class="calendar"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</body>
	</html>

