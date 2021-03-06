<?php
include_once('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/estilos.css">
	<title>Seguridad (ANTV)</title>
</head>

<body class="bg-grey">
	<div class="preloader-background">
		<div class="preloader-wrapper big active">
			<div class="spinner-layer spinner-antv">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>
		</div>
	</div>
	<header>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<svg class="svg-titulo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 697.2 451.21">
						<defs>
							<style>
								.cls-1,
								.cls-7 {
									fill: #fff;
								}

								.cls-1 {
									opacity: 0;
								}

								.cls-2 {
									fill: #cc2259;
								}

								.cls-3 {
									fill: #e69c3d;
								}

								.cls-4 {
									fill: #4fc6e0;
								}

								.cls-5 {
									fill: #e8d43a;
								}

								.cls-6 {
									fill: #2b91d1;
								}

								.cls-7 {
									font-size: 22px;
									font-family: ArchivoBlack-Regular, Archivo Black;
								}

								.cls-8 {
									letter-spacing: -0.02em;
								}

								.cls-9 {
									letter-spacing: -0.02em;
								}
							</style>
						</defs>
						<title>SDCA</title>
						<g id="Capa_2" data-name="Capa 2">
							<g id="backgorund-body">
								<rect class="cls-1" width="697.2" height="451.21" />
								<g id="animacion-rectangulo">
									<rect class="cls-2" x="121" y="151.27" width="250.14" height="80.66" transform="translate(-62.83 148.7) rotate(-30)" />
								</g>
								<g id="animacion-rectangulo-2">
									<rect class="cls-3" x="159.37" y="225.57" width="171.83" height="35.38" transform="translate(-88.77 155.23) rotate(-30)"
									/>
								</g>
								<g id="animacion-rectangulo-3">
									<rect class="cls-2" x="111.69" y="307.63" width="180.86" height="11.42" transform="matrix(0.87, -0.5, 0.5, 0.87, -129.59, 143.04)"
									/>
								</g>
								<g id="animacion-rectangulo-4">
									<rect class="cls-4" x="299.91" y="191.28" width="287.08" height="85.32" transform="translate(-57.56 253.07) rotate(-30)"
									/>
								</g>
								<g id="animacion-rectangulo-5">
									<rect class="cls-3" x="389.13" y="134.93" width="148.06" height="41.52" transform="translate(-15.79 252.44) rotate(-30)"
									/>
								</g>
								<g id="animacion-rectangulo-6">
									<rect class="cls-5" x="345.76" y="183.38" width="173.26" height="38.66" transform="translate(-43.43 243.35) rotate(-30)"
									/>
								</g>
								<g id="animacion-rectangulo-7">
									<rect class="cls-6" x="288.84" y="218.3" width="82.09" height="21.2" transform="translate(-70.26 195.61) rotate(-30)" />
								</g>
								<text class="cls-7" transform="translate(123.47 234.94)">SISTEMA DE CONT
									<tspan class="cls-8" x="227.32" y="0">R</tspan>
									<tspan x="244.05" y="0">OL Y </tspan>
									<tspan class="cls-9" x="308.84" y="0">A</tspan>
									<tspan x="325.55" y="0">CCESO</tspan>
								</text>
							</g>
						</g>
					</svg>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="container">
			<div class="row">
				<div class="col s8 offset-s2 card-panel hoverable">
					<div class="row">
						<div class="col s10 offset-s1">
							<?php
							if (!isset($_POST['cedula']) and !isset($_POST['respuesta'] )){	
							?>
							<h4 class="center-align">Recuperar Contraseña</h4>
							<form action="#" method='POST' class='form-validate' id="test">
								<div class="row">
									<div class="input-field col s8 offset-s2">
										<input type="text" name="cedula" class="validate" data-length="12">
										<label for="textfield">Cedula</label>
									</div>
								</div>
								<br>
								<div class="col s12">
									<a href="index.php" class="left color-antv-1 waves-effect waves-light btn">Volver</a>
									<button type="submit" class="right color-antv-1 waves-effect waves-light btn">Siguiente</button>
								</div>
							</form>
							<?php
							}
							?>
							<?php
							if (isset($_POST['cedula']) and !isset($_POST['respuesta'])) {
							$cedula=$_POST['cedula'];
							$consulta=mysql_query("SELECT * FROM usuario WHERE ced_usu='$cedula'");

							if ($registro=mysql_num_rows($consulta)) {
							if ($registro>0) {
							if ($dato=mysql_fetch_array($consulta)) {
							$pregunta=$dato['pre_usu'];
							}

							}

							}	
							else {
							echo "<script languaje='javascript'> alert('Cédula No Existe')  </script>";
							echo "<script languaje='javascript'> window.location='recuperar-contrasena.php'  </script>";
							}	


							?>
							<h4 class="center-align">Pregunta Secreta</h4>
							<form action="#" method='POST' class='form-validate' id="test">
								<div class="row">
									<div class="col s8 offset-s2">
										<input type="hidden" name="cedula" value="<?php echo "$cedula"; ?>">
										<input type="text" name='pregunta' value="<?php echo "$pregunta"; ?>" readonly>
									</div>
									<div class="input-field col s8 offset-s2">
										<input type="text" name="respuesta" class="validate">
										<label for="textfield">Respuesta</label>
									</div>
								</div>
								<br>
								<div class="col s12">
									<a href="index.php" class="left color-antv-1 waves-effect waves-light btn">Volver</a>
									<button type="submit" class="right color-antv-1 waves-effect waves-light btn">Siguiente</button>
								</div>
							</form>
							<?php
							}
							?>
							<?php
							if (isset($_POST['respuesta'])) {
							$cedula=$_POST['cedula'];
							$respuesta=$_POST['respuesta'];
							$consulta=mysql_query("SELECT * FROM usuario WHERE ced_usu='$cedula' AND res_usu='$respuesta'");

							if ($registro=mysql_num_rows($consulta)) {
							if ($registro>0) {
							if ($dato=mysql_fetch_array($consulta)) {
							$pregunta=$dato['pre_usu'];
							}

							}

							}	
							else {
							echo "<script languaje='javascript'> alert('La Respuesta No Coincide')  </script>";
							echo "<script languaje='javascript'> window.location='recuperar-contrasena.php'  </script>";
							}	
							?>
							<h4 class="center-align">Nueva Contraseña</h4>
							<form action="cambio-contrasena.php" method='GET' class='form-validate' id="test">
								<div class="row">
									<div class="input-field col s8 offset-s2">
										<input type="password" name="nueva" value="">
										<label for="textfield">Nueva</label>
									</div>
									<div class="input-field col s8 offset-s2">
										<input type="password" name="repetir" class="validate">
										<input type="hidden" name="cedula" value="<?php echo $cedula;  ?>">
										<label for="textfield">Confirmar</label>
									</div>
								</div>
								<br>
								<div class="col s12">
									<a href="index.php" class="left color-antv-1 waves-effect waves-light btn">Volver</a>
									<button type="submit" class="right color-antv-1 waves-effect waves-light btn">Siguiente</button>
								</div>
							</form>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="bg-grey page-footer">
		<div class="container">
			<p class="copyright center-align">Copyright © 2017 Sistemas ANTV. Todos los derechos reservados </p>
		</div>
	</footer>
	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.js"></script>
	<script src="js/loader.js"></script>
</body>

</html>