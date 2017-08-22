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
	VALUES ('','$usuario','Módulo Personal','$fecha','$hora')");




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
$menupersonal="active";
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
                            <a href="#" class="brand-logo">Listado de Personal</a>
                            <a href="#add" class="btn-floating btn-large halfway-fab waves-effect waves-light teal">
                                <i class="color-antv-1 material-icons">add</i>
                            </a>
                        </div>
                    </nav>
                    <!--MODAL AÑADIR-->
            <div id="add" class="modal">
                <div class="modal-content">
                    <nav>
                        <div class="color-antv-1 nav-wrapper">
                            <a class="brand-logo"><i class="material-icons">search</i>Añadir Personal</a>
                        </div>
                    </nav>
                    <div class="row">
                        <form action="#" method="POST" class="col s12">
                            <div class="row">
                                <div class="file-field input-field col s6">
                                    <div class="color-antv-1 btn">
                                        <span>Foto</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input name="foto1" class="file-path validate" type="text">
                                    </div>
                                </div>
                                <div class="input-field col s6">
                                    <input name="cedula" id="first_name" class="validate" data-length="10" value="V-">
                                    <label for="textfield" class="active">Cedula</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="nombre" id="first_name" class="validate" required >
                                    <label for="confirmfield">Nombre</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="apellido" id="first_name" class="validate" required >
                                    <label for="textfield">Apellido</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="edificio" id="first_name" class="validate" required >
                                    <label for="textfield">Edificio</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="departamento" id="first_name" class="validate" required >
                                    <label for="confirmfield">Gerencia</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="coordinacion" id="first_name" class="validate" required >
                                    <label for="confirmfield">Coordinación</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="cargo" id="first_name" class="validate" required >
                                    <label for="confirmfield">Cargo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="local" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Ejemplo: 0212-0000000">
                                    <label for="textfield">Telefono Local</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" name="celular" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Ejemplo: 0426-0000000">
                                    <label for="textfield">Celular</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                    <a href="#!" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                    <input type="submit" class="color-antv-1 waves-effect waves-light btn" value="Guardar">
                </div>
                        </form>
                    </div>
                </div>
            </div>
       
                    <table class="highlight margin-table" id="Jtabla">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="cedula-table">Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Edificio</th>
                                <th>Gerencia</th>
                                <th class="section-btn"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $formulario_personal=mysql_query("SELECT * FROM personal");
                            while ($consulta=mysql_fetch_array($formulario_personal)){

                            ?>
                            <tr>
                                <td><?php echo $consulta['ide_per']; ?></td>
                                <td><?php echo $consulta['ced_usu']; ?></td>
                                <td><?php echo $consulta['nom_per']; ?></td>
                                <td><?php echo $consulta['ape_per']; ?></td>
                                <td><?php echo $consulta['edif_per']; ?></td>
                                <td><?php echo $consulta['dep_per']; ?></td>
                                
                                <td>
                                <div class="btn-gp fixed-action-btn horizontal click-to-toggle">
                                    <a class="color-antv-2 btn-floating red">
                                        <i class="material-icons">menu</i>
                                    </a>
                                    <ul>
                                        <li><a href="#ver<?php echo $consulta['ide_per']; ?>" class="color-antv-4 btn-floating"><i class="material-icons">pageview</i></a></li>
                                        <li><a href="#modificar<?php echo $consulta['ide_per']; ?>" class="color-antv-1 btn-floating"><i class="material-icons">mode_edit</i></a></li>
                                        <li><a href="#eliminar<?php echo $consulta['ide_per']; ?>" class="color-antv-3 btn-floating green"><i class="material-icons">delete</i></a></li>
                                        <li><a href="#visitas<?php echo $consulta['ced_usu']; ?>" class="color-antv-5 btn-floating blue"><i class="material-icons">assignment_ind</i></a></li>
                                    </ul>
                                </div>
            <!--MODAL VER-->
            <div id="ver<?php echo $consulta['ide_per']; ?>" class="modal">
                <div class="modal-content">
                    <nav>
                        <div class="color-antv-1 nav-wrapper">
                            <a class="brand-logo">Ver Personal</a>
                            <img class="foto right z-depth-5" src="../img/<?php echo $consulta['fotos_per'];?>">
                        </div>
                    </nav>
                    <div class="row">
                        <form action="#" method="POST" class="col s12">
                            <div class="row">
                                <div class="input-field col s6">
                                    
                                    <label for="textfield">Cedula: <?php echo $consulta['ced_usu'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    
                                    <label for="confirmfield">Nombre: <?php echo $consulta['nom_per'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    
                                    <label for="textfield">Apellido: <?php echo $consulta['ape_per'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    
                                    <label for="textfield">Edificio: <?php echo $consulta['edif_per'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    
                                    <label for="confirmfield">Gerencia: <?php echo $consulta['dep_per'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    
                                    <label for="confirmfield">Coordinación: <?php echo $consulta['coor_per'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    
                                    <label for="confirmfield">Cargo: <?php echo $consulta['carg_per'];?></label>
                                </div>
                                <div class="input-field col s6">
                                    
                                    <label for="textfield">Telefono Local: <?php echo $consulta['tlf_per'];?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <label for="textfield">Celular: <?php echo $consulta['cel_per'];?></label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="#!" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <!--MODAL MODIFICAR-->
            <div id="modificar<?php echo $consulta['ide_per']; ?>" class="modal">
                <div class="modal-content">
                    <nav>
                        <div class="color-antv-1 nav-wrapper">
                            <a class="brand-logo">Modificar Personal</a>
                            <img class="foto right z-depth-5" src="../img/<?php echo $consulta['fotos_per'];?>">
                        </div>
                    </nav>
                    <br>
                    <div class="row">
                        <form action="#" method="POST" class="col s12">
                            <div class="none input-field col s6">
                                <input type="hidden" name="idem" id="first_name" class="validate"  value="<?php echo $consulta['ide_per'];?>">
                                
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="cedulam" id="first_name" class="validate"  value="<?php echo $consulta['ced_usu'];?>">
                                <label for="textfield" class="active">Cedula</label>
                            </div>
                             
                            <div class="input-field col s6">
                                <input type="text" name="nombrem" id="first_name" class="validate" required  value="<?php echo $consulta['nom_per'];?>">
                                <label for="confirmfield" class="active">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="apellidom" id="first_name" class="validate" required  value="<?php echo $consulta['ape_per'];?>">
                                <label for="textfield" class="active">Apellido</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="edificiom" id="first_name" class="validate" required  value="<?php echo $consulta['edif_per'];?>">
                                <label for="textfield" class="active">Edificio</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="departamentom" id="first_name" class="validate" required value="<?php echo $consulta['dep_per'];?>">
                                <label for="confirmfield" class="active">Gerencia</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="coordinacionm" id="first_name" class="validate" required  value="<?php echo $consulta['coor_per'];?>">
                                <label for="confirmfield" class="active">Coordinación</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="cargom" id="first_name" class="validate" required  value="<?php echo $consulta['carg_per'];?>">
                                <label for="confirmfield" class="active">Cargo</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="localm" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Ejemplo: 0212-0000000" value="<?php echo $consulta['tlf_per'];?>">
                                <label for="textfield" class="active">Telefono Local</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="celularm" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Ejemplo: 0426-0000000" value="<?php echo $consulta['cel_per'];?>">
                                <label for="textfield" class="active">Celular</label>

                            </div>


                            <div class="modal-footer">
                            <a href="#" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                             <input type="submit" class="color-antv-1 waves-effect waves-light btn" value="Guardar">
                            </div>

                        </form>
                    </div>
                </div>
                
            </div>




            <!--MODAL ELIMINAR-->
            <div id="eliminar<?php echo $consulta['ide_per']; ?>" class="modal">
                <div class="modal-content">
                    <nav>
                        <div class="color-antv-1 nav-wrapper">
                            <a class="brand-logo">Eliminar Personal</a>
                            <img class="foto right z-depth-5" src="../img/<?php echo $consulta['fotos_per'];?>">
                        </div>
                    </nav>
                    <br>
                    <div class="row">
                        <form action="#" method="POST" class="col s12">
                             <div class="none input-field col s6">
                                <input type="hidden" name="idee" id="first_name" class="validate"  value="<?php echo $consulta['ide_per'];?>">
                                
                            </div>
                           
                            <div class="input-field col s6">
                                <input type="text" name="nombree" id="first_name" class="validate" required  value="<?php echo $consulta['nom_per'];?>">
                                <label for="confirmfield" class="active">Nombre</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="apellidoe" id="first_name" class="validate"  value="<?php echo $consulta['ape_per'];?>">
                                <label for="textfield" class="active">Apellido</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="edificioe" id="first_name" class="validate"   value="<?php echo $consulta['edif_per'];?>">
                                <label for="textfield" class="active">Edificio</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="departamentoe" id="first_name" class="validate" required  value="<?php echo $consulta['dep_per'];?>">
                                <label for="confirmfield" class="active">Gerencia</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="coordinacione" id="first_name" class="validate" required  value="<?php echo $consulta['coor_per'];?>">
                                <label for="confirmfield" class="active">Coordinación</label>
                            </div>

                            <div class="input-field col s6">
                                <input type="text" name="cargoe" id="first_name" class="validate" required  value="<?php echo $consulta['carg_per'];?>">
                                <label for="confirmfield" class="active">Cargo</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="locale" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Ejemplo: 0212-0000000" value="<?php echo $consulta['tlf_per'];?>">
                                <label for="textfield" class="active">Telefono Local</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="celulare" id="first_name" class="validate" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" pattern="[0-9]{4,4}-[0-9]{7,7}" title="Ejemplo: 0426-0000000" value="<?php echo $consulta['cel_per'];?>">
                                <label for="textfield" class="active">Celular</label>
                            </div>
                    <?php
    if (isset($_POST['idee'])) {
        $cedulae=$_POST['cedulae'];
        $idee=$_POST['idee'];
        $nombree=$_POST['nombree'];
        $apellidoe=$_POST['apellidoe'];
        $edificioe=$_POST['edificioe'];
        $departamentoe=$_POST['departamentoe'];
        $coordinacione=$_POST['coordinacione'];
        $cargoe=$_POST['cargoe'];
        $telefonoe=$_POST['locale'];
        $celulare=$_POST['celulare'];

mysql_query("DELETE FROM `personal` WHERE `personal`.`ide_per` = '$idee'");

echo "<script language='javascript'>alert('Su Personal Ha Sido Eliminado')</script>";
echo "<script language='javascript'>window.location='gestionar_personal.php'</script>";
}
?>



                    <div class="modal-footer">
                        <a href="#!" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                        <input type="submit" class="color-antv-1 waves-effect waves-light btn" value="Eliminar">
                    </div>
                        </form>
                    </div>
                </div>

                   
            </div>
            <!--MODAL VISITAS-->
            <div id="visitas<?php echo $consulta['ced_usu']; ?>" class="modal">
                <div class="modal-content">
                    <nav>
                        <div class="color-antv-1 nav-wrapper">
                            <a class="brand-logo">Listado de Visitas</a>
                            <a href="reporte_listado_visitas_personal_fpdf.php" target="_blank" class="btn-floating btn-large halfway-fab waves-effect waves-light teal">
                                <i class="color-antv-2 material-icons">print</i>
                            </a>
                        </div>
                    </nav>
                    <br>
                    <table class="highlight" id="Jtabla">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Tipo visita</th>
                                <th>Fecha</th>
                                <th>Hora Ent</th>
                                <th>Hora Sal</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $formulario_visitas=mysql_query("SELECT * from visitas WHERE visitas.ced_usu='".$consulta['ced_usu']."'");
                                while ($consulta=mysql_fetch_array($formulario_visitas)){

                                ?>
                            <tr>
                                <td><?php echo $consulta['id_visi']; ?></td>
                                <td><?php echo $consulta['ced_visi']; ?></td>
                                <td><?php echo $consulta['nom_visi']; ?></td>
                                <td><?php echo $consulta['ape_visi']; ?></td>
                                <td><?php echo $consulta['tip_visi']; ?></td>
                                <td><?php echo $consulta['fec_visi']; ?></td>
                                <td><?php echo $consulta['hor_ent']; ?></td>
                                <td><?php echo $consulta['hor_sal']; ?></td>

</td>
                    </tr>
                    <?php
                                }
                                ?>
                </tbody>
            </table>
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
$telefonom=$_POST['localm'];
$celularm=$_POST['celularm'];




mysql_query("UPDATE `personal` SET `ced_usu` = '$cedulam', `nom_per` = '$nombrem', `ape_per` = '$apellidom', `edif_per` = '$edificiom', `dep_per` = '$departamentom', `coor_per` = '$coordinacionm', `carg_per` = '$cargom', `tlf_per` = '$telefonom', `cel_per` = '$celularm' WHERE `personal`.`ide_per` =$idem;");

echo "<script language='javascript'>alert('Usuario Ha Sido Modificado')</script>";
echo "<script language='javascript'>window.location='gestionar_personal.php'</script>";
}
?>

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
            $foto1=$_POST['foto1'];
            

            $consulta_cedula=mysql_query("SELECT ced_usu FROM personal WHERE ced_usu='$cedula'");
            $verificacion_cedula=mysql_num_rows($consulta_cedula);
            if ($verificacion_cedula>0) {

            echo "<script language='javascript'>alert('Personal Ya Existe')</script>";
            echo "<script language='javascript'>window.location=('gestionar_personal.php')</script>";
            }

            else{

            mysql_query("INSERT INTO personal (ced_usu,nom_per,ape_per,edif_per,dep_per,coor_per,carg_per,tlf_per,cel_per,fotos_per) 
            VALUES ('$cedula','$nombre','$apellido','$edificio','$departamento','$coordinacion','$cargo','$local','$celular','$foto1')");

            echo "<script language='javascript'>alert('Su Personal Ha Sido Añadido')</script>";
            echo "<script language='javascript'>window.location=('gestionar_personal.php')</script>";
            }
            }   
            ?>

    </body>

    </html>