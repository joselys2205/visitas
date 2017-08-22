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
	VALUES ('','$usuario','Módulo Gestionar Usuario','$fecha','$hora')");



if (!empty($_GET['estatus'])) {
$ide=$_GET['estatus'];	
$estado=mysql_query("SELECT * FROM usuario WHERE ide_usu='$ide'");

while($dato1=mysql_fetch_array($estado)) {
	$estatus_actual=$dato1['estado'];
		if ($estatus_actual=='activo') {
		mysql_query("UPDATE usuario SET estado='inhabilitado' WHERE ide_usu='$ide'"); 
		header("location:gestionar_usuario.php");
		}
		else{
			mysql_query("UPDATE usuario SET estado='activo' WHERE ide_usu='$ide'");
			header("location:gestionar_usuario.php");
		}
}

}
$menugestionarusuario="active";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Seguridad ANTV</title>
        <?php
	include("head.php");
	?>
    </head>

    <body>
        <?php
    include('navegacion.php');
    ?>
            <br>
            <div class="">
                <div class="row">
                    <nav>
                        <div class="color-antv-4 nav-wrapper">
                            <a href="#" class="brand-logo">Gestionar Usuario</a>
                            <a href="#add" class="btn-floating btn-large halfway-fab waves-effect waves-light teal">
                                <i class="color-antv-1 material-icons">add</i>
                            </a>
                        </div>
                    </nav>
                    <table class="highlight margin-table" id="Jtabla">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Usuario</th>
                                <th>Tipo De Usuario</th>
                                <th>Visitas Registradas</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $formulario_usuario=mysql_query("SELECT * FROM usuario");
                            while ($consulta=mysql_fetch_array($formulario_usuario)){
                            ?>
                            <tr>
                                <td><?php echo $consulta['ide_usu']; ?></td>
                                <td><?php echo $consulta['nom_usu']; ?></td>
                                <td><?php echo $consulta['ape_usu']; ?></td>
                                <td><?php echo $consulta['nick_usu']; ?></td>
                                <td><?php echo $consulta['tip_usu']; ?></td>
                                <td><?php 	
                                    $contador_visitas=$consulta['ide_usu'];
                                    $registros_usuario_visitas=mysql_query("SELECT COUNT(*) FROM visitas WHERE `ide_usu`='$contador_visitas'");
                                    echo "$registros_usuario_visitas";
                                    ?> 
                                    <!--esto tiene que ingrementar todas las veces que cada usuario haga un registro de visitas-->
                                </td>
                                <td><?php $estatus = $consulta['estado']; 

													$ide=$consulta['ide_usu'];
											if ($estatus=='activo') {
											
												echo '<a href="gestionar_usuario.php?estatus='.$ide.'" class="btn green">Activo</a>';
											}

											else{
												echo '<a href="gestionar_usuario.php?estatus='.$ide.'"  class="btn  red">Inhabilitado</a>';
											}


											?></td>
                                <td>
                                    <a href="#ver<?php echo $consulta['ide_usu']; ?>" class="color-antv-1 waves-effect waves-light btn">Ver</a>
            <!--MODAL AÑADIR-->
                <div id="add" class="modal">
                    <div class="modal-content">
                        <nav>
                            <div class="color-antv-1 nav-wrapper">
                                <a class="brand-logo"><i class="material-icons">search</i>Añadir Usuarios</a>
                            </div>
                        </nav>
                        <div class="row">
                            <form action="#" method="POST" class="col s12">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="text" name "cedulausu" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}">
                                        <label for="textfield">Cedula</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" name="nombreusu" id="first_name" class="validate" required pattern="[^0-9!$%&/()=?¿*@]{1,20}$" title="No Admite caracteres especiales ni números.">
                                        <label for="confirmfield">Nombre</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="text" name="apellidousu" id="first_name" class="validate" required pattern="[^0-9!$%&/()=?¿*@]{1,20}$" title="No Admite caracteres especiales ni números.">
                                        <label for="textfield">Apellido</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" name "nickusu" id="first_name" class="validate">
                                        <label for="textfield">Nick Usuario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="password" name="contrasenausu" id="first_name" class="validate">
                                        <label for="confirmfield">Contraseña</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input type="text" name="preuntausu" id="first_name" class="validate" required pattern="[^0-9!$%&/()=?¿*@]{1,20}$" title="No Admite caracteres especiales ni números.">
                                        <label for="confirmfield">Pregunta Secreta</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input type="text" name="respuestausu" id="first_name" class="validate" required pattern="[^0-9!$%&/()=?¿*@]{1,20}$" title="No Admite caracteres especiales ni números.">
                                        <label for="confirmfield">Respuesta Secreta</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="nivelusu">
                                                <option label="Seleccione">Seleccione</option>
                                                <option value="admin">Administrador</option>
                                                <option value="secretaria">Secretaria</option>
                                                <option value="inspector">Inspector</option>
                                        </select>
                                        <label for="textfield">Nivel de Usuario</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select name="estatususuario">
                                                <option label="Seleccione">Seleccione</option>
                                                <option label="activo">Activo</option>
                                                <option label="inhabilitado">Inhabilitado</option>
                                        </select>
                                        <label for="textfield">Estadus del Usuario</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                        <input type="submit" class="color-antv-1 waves-effect waves-light btn" value="Guardar">
                    </div>
                            </form>
                        </div>
                    </div>
                <?php
                    if (isset($_POST['cedula'])) {
                    $cedula=$_POST['cedula'];
                    $nombre=$_POST['nombre'];
                    $apellido=$_POST['apellido'];
                    $edificio=$_POST['edificio'];
                    $departamento=$_POST['departamento'];
                    $coordinacion=$_POST['coordinacion'];
                    $cargo=$_POST['cargo'];
                    $local=$_POST['local'];
                    $celular=$_POST['celular'];
                    $visitante=$_POST['visitante'];

                    $consulta_cedula=mysql_query("SELECT ced_usu FROM personal WHERE ced_usu='$cedula'");
                    $verificacion_cedula=mysql_num_rows($consulta_cedula);
                    if ($verificacion_cedula>0) {

                    echo "<script language='javascript'>alert('Personal Ya Existe')</script>";
                    echo "<script language='javascript'>window.location=('gestionar_personal.php')</script>";
                    }

                    else{

                    mysql_query("INSERT INTO personal (ced_usu,nom_per,ape_per,edif_per,dep_per,coor_per,carg_per,tlf_per,cel_per,ced_visi) 
                    VALUES ('$cedula','$nombre','$apellido','$edificio','$departamento','$coordinacion','$cargo','$local','$celular','$visitante')");

                    echo "<script language='javascript'>alert('Su Personal Ha Sido Añadido')</script>";
                    echo "<script language='javascript'>window.location=('gestionar_personal.php')</script>";
                    }
                    }	
                    ?>
            </div>
            <!--MODAL VER-->
            <div id="ver<?php echo $consulta['ide_usu']; ?>" class="modal">
                <div class="modal-content">
                    <nav>
                        <div class="color-antv-1 nav-wrapper">
                            <a class="brand-logo"><i class="material-icons">search</i>Ver usuario</a>
                        </div>
                    </nav>
                    <div class="row">
                        <form action="#" method="POST" class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="textfield">Apellido:<?php echo $consulta['ced_usu'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    <label for="confirmfield">Apellido:<?php echo $consulta['ape_usu'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="textfield">Nombre de Usuario:<?php echo $consulta['nick_usu'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    <label for="textfield">Contrasena:<?php echo $consulta['cont_usu'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="confirmfield">Tipo de Usuario:<?php echo $consulta['tip_usu'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    <label for="confirmfield">Pregunta Secreta:<?php echo $consulta['pre_usu'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="confirmfield">Respuesta Secreta:<?php echo $consulta['res_usu'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    <label for="textfield">Estado:<?php echo $consulta['estado'];?></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                    <a href="#!" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                </div>
                        </form>
                    </div>
                </div>
            </div>
                </td>
                    </tr>
                    <?php
                                }
                                ?>
                        </tbody>
                    </table>

                </div>
            </div>

<?php
if (isset($_POST['cedulam'])) {
$cedulam=$_POST['cedulam'];
$idem=$_POST['idem'];
$nombrem=$_POST['nombrem'];
$apellidom=$_POST['apellidom'];
$edificiom=$_POST['edificiom'];
$departamentom=$_POST['departamentom'];
$coordinacionm=$_POST['coordinacionm'];
$cargom=$_POST['cargom'];
$telefonom=$_POST['telefonom'];
$celularm=$_POST['celularm'];


mysql_query("UPDATE `personal` SET `ced_usu` = '$cedulam', `nom_per` = '$nombrem', `ape_per` = '$apellidom', `edif_per` = '$edificiom', `dep_per` = '$departamentom', `coor_per` = '$coordinacionm', `carg_per` = '$cargom', `tlf_per` = '$telefonom', `cel_per` = '$celularm' WHERE `personal`.`ide_per` = $idem;");

echo "<script language='javascript'>alert('Usuario Ha Sido Modificado')</script>";
echo "<script language='javascript'>window.location='gestionar_personal.php'</script>";
}
?>
    </body>

    </html>