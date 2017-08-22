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
	VALUES ('','$usuario','Módulo Configuración','$fecha','$hora')");

$menuconfiguracion="active";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Seguridad (ANTV)</title>
    <?php
	include("head.php");
	?>
</head>
<body>
   <?php
	include('navegacion.php');
	?>
<section>
<div class="container">
    <div class="row">
        <div class="col s8 offset-s2 card-panel hoverable">
            <div class="row">
                <div class="col s10 offset-s1">
                    <h4 class="center-align">Modificar Usuario</h4>
                    <img class="foto-modu right z-depth-5" src="../img/joselys.jpg">
                </div>
                <form class="form-antv col s12" action="#" method='POST' class='form-validate' id="bb">
                    <div class="row">
                        <div class="file-field input-field col s8 offset-s2">
                            <div class="color-antv-1 btn">
                                <span>Cambiar Foto</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input name="foto1" class="file-path validate" type="text">
                            </div>
                        </div>
                        <div class="input-field col s8 offset-s2">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" class="validate" name="nombre" value="<?php echo $dato['nom_usu'];?>">
                            <label for="usuario">Nombre</label>
                        </div>
                        <div class="input-field col s8 offset-s2">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" class="validate" name="apellido" value="<?php echo $dato['ape_usu'];?>">
                            <label for="usuario">Apellido</label>
                        </div>
                        <div class="input-field col s8 offset-s2">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" class="validate" name="usuario" value="<?php echo $dato['nick_usu'];?>">
                            <label for="usuario">Nombre de Usuario</label>
                        </div>
                        <div class="input-field col s8 offset-s2">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" class="validate" name="contrasena" value="<?php echo $dato['cont_usu'];?>">
                            <label for="usuario">Contraseña</label>
                        </div>
                        <div class="input-field col s8 offset-s2">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" class="validate" name="pregunta" value="<?php echo $dato['pre_usu'];?>">
                            <label for="usuario">Pregunta Secreta</label>
                        </div>
                        <div class="input-field col s8 offset-s2">
                            <i class="material-icons prefix">account_circle</i>
                            <input type="text" class="validate" name="repuesta" value="<?php echo $dato['res_usu'];?>">
                            <label for="usuario">Respuesta Secreta</label>
                        </div>
                    </div>
                    <div class="container">
                        <div class="modal-footer btn-conf">
                            <a href="#!" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                            <input type="submit" class="color-antv-1 waves-effect waves-light btn" value="Guardar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    
</body>
</html>