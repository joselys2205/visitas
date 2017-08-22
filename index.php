<?php
	session_start();
	if (!empty($_SESSION['tipo'])=="admin") {
		header("location:admin/index.php");
	}
	if(!empty($_SESSION['tipo'])=="inspector") {
		header("location:inspector/index.php");
	}

	if(!empty($_SESSION['tipo'])=="secretaria") {
		header("location:secretaria/index.php");
	}

	include_once("conexion.php");

	if (isset($_POST['usuario'])) {
		$usuario=$_POST['usuario'];
		$clave=$_POST['clave'];
		$verificar=mysql_query("SELECT * FROM usuario WHERE nick_usu='$usuario' and cont_usu='$clave'");

		if ($dato=mysql_fetch_array($verificar)) {
		$_SESSION['usuario']=$dato['nick_usu'];
		$_SESSION['tipo']=$dato['tip_usu'];
		$_SESSION['cedula']=$dato['ced_usu'];

		$estado=$dato['estado'];
		
		if ($_SESSION['tipo']=="admin") {
			if ($estado=="activo") {
				header("location:admin/index.php");
			}
			else{
				$_SESSION['tipo']=NULL; 
				header("location:usuario-inhabilitado.php");
			}
			
		}
		else if($_SESSION['tipo']=="inspector"){
			if ($estado=="activo") {
				header("location:inspector/index.php");
			}
			else{
				$_SESSION['tipo']=NULL; 
				header("location:usuario-inhabilitado.php");
			}

		}
		else if ($_SESSION['tipo']=="secretaria"){
			if ($estado=="activo") {
				header("location:secretaria/index.php");
			}
			else{
				$_SESSION['tipo']=NULL; 
				header("location:usuario-inhabilitado.php");
			}
		}
			}
	else{
		header("location:usuario-incorrecto.php");
		}
			
	}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
                        <svg class="svg-titulo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 697.2 451.21"><defs><style>.cls-1,.cls-7{fill:#fff;}.cls-1{opacity:0;}.cls-2{fill:#cc2259;}.cls-3{fill:#e69c3d;}.cls-4{fill:#4fc6e0;}.cls-5{fill:#e8d43a;}.cls-6{fill:#2b91d1;}.cls-7{font-size:22px;font-family:ArchivoBlack-Regular, Archivo Black;}.cls-8{letter-spacing:-0.02em;}.cls-9{letter-spacing:-0.02em;}</style></defs><title>SDCA</title><g id="Capa_2" data-name="Capa 2"><g id="backgorund-body"><rect class="cls-1" width="697.2" height="451.21"/><g id="animacion-rectangulo"><rect class="cls-2" x="121" y="151.27" width="250.14" height="80.66" transform="translate(-62.83 148.7) rotate(-30)"/></g><g id="animacion-rectangulo-2"><rect class="cls-3" x="159.37" y="225.57" width="171.83" height="35.38" transform="translate(-88.77 155.23) rotate(-30)"/></g><g id="animacion-rectangulo-3"><rect class="cls-2" x="111.69" y="307.63" width="180.86" height="11.42" transform="matrix(0.87, -0.5, 0.5, 0.87, -129.59, 143.04)"/></g><g id="animacion-rectangulo-4"><rect class="cls-4" x="299.91" y="191.28" width="287.08" height="85.32" transform="translate(-57.56 253.07) rotate(-30)"/></g><g id="animacion-rectangulo-5"><rect class="cls-3" x="389.13" y="134.93" width="148.06" height="41.52" transform="translate(-15.79 252.44) rotate(-30)"/></g><g id="animacion-rectangulo-6"><rect class="cls-5" x="345.76" y="183.38" width="173.26" height="38.66" transform="translate(-43.43 243.35) rotate(-30)"/></g><g id="animacion-rectangulo-7"><rect class="cls-6" x="288.84" y="218.3" width="82.09" height="21.2" transform="translate(-70.26 195.61) rotate(-30)"/></g><text class="cls-7" transform="translate(123.47 234.94)">SISTEMA DE CONT<tspan class="cls-8" x="227.32" y="0">R</tspan><tspan x="244.05" y="0">OL Y </tspan><tspan class="cls-9" x="308.84" y="0">A</tspan><tspan x="325.55" y="0">CCESO</tspan></text></g></g></svg>
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
                                <h4 class="center-align">Iniciar sesión</h4>
                            </div>
                            <form class="form-antv col s12" action="#" method='POST' class='form-validate' id="test">
                                <div class="row">
                                    <div class="input-field col s8 offset-s2">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input type="text" class="validate" name='usuario'>
                                        <label for="usuario">Usuario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s8 offset-s2">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <input id="password" type="password" class="validate" name='clave'>
                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s10 offset-s1">
                                        <input class="right color-antv-1 waves-effect waves-light btn" type="submit" value="Acceder">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
        <footer class="bg-grey page-footer">
            <div class="container">
                <p class="copyright center-align">Copyright © 2017 Sistemas ANTV. Todos los derechos reservados  </p>
            </div>
        </footer>
        <script src="js/jquery.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/loader.js"></script>
    </body>

    </html>