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
    VALUES ('','$usuario','Módulo Visitas','$fecha','$hora')");




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
$menuvisitas="active";
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
<section>
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 card-panel hoverable">
                <div class="row">
                    <div class="col s10 offset-s1">
                        <h4 class="center-align">Visitas Existente</h4>
                    </div>
                    <form class="form-antv col s12" action="#" method='POST' class='form-validate' id="test">
                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" class="validate" name="cedulanueva">
                                <label for="usuario">Cedula</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <i class="material-icons prefix">account_circle</i>
                                <select name="tiponueva">
                                    <option value="">Seleccione...</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Laboral">Laboral</option>
                                </select>
                                <label>Tipo de Visita</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="date" name="fechanueva"  class="validate" value="<?php echo date("Y-m-d");?>">
                                <label class="active" for="first_name">Fecha Nueva</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="time" name="horanueva"  class="validate" value="12:00:00" min="00:00:00">
                                <label class="active" for="first_name">Hora Entrada Nueva</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" name="personalnueva" class="validate">
                                <label for="first_name">Trabajador ANTV</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <i class="material-icons prefix">account_circle</i>
                                 <input type="text" name="descripcionnueva" class="validate">
                                <label class="active" for="first_name">Descripción</label>
                            </div>
                        </div>
            <?php
        if (isset($_POST['cedulanueva'])) {
            $cedulanueva=$_POST['cedulanueva'];
            $tiponueva=$_POST['tiponueva'];
            $fechanueva=$_POST['fechanueva'];
            $horanueva=$_POST['horanueva'];
            $personalnueva=$_POST['personalnueva'];
            $descripcionnueva=$_POST['descripcionnueva'];


    $formulario_visitas=mysql_query("SELECT nom_visi, ape_visi,corr_visi FROM visitas WHERE ced_visi = '".$cedulanueva."' ORDER BY id_visi ASC; ");
    $consulta=mysql_fetch_array($formulario_visitas, MYSQL_ASSOC);

    $nombre   = $consulta['nom_visi'];
    $apellido = $consulta['ape_visi'];
    $correo = $consulta['corr_visi'];

    mysql_query("INSERT INTO visitas (ced_visi,nom_visi,ape_visi,corr_visi,tip_visi,fec_visi,hor_ent,ced_usu,des_visi) 
        VALUES ('$cedulanueva','$nombre','$apellido','$correo','$tiponueva','$fechanueva','$horanueva','$personalnueva','$descripcionnueva')");

        echo "<script language='javascript'>alert('Su Visita Ha Sido Añadido')</script>";

        echo "<script language='javascript'>window.location=('visitas.php')</script>";


}	
        ?>
                        <div class="row">
                            <div class="col s4 offset-s2">
                               <div class="form-actions">
                                     <input class="color-antv-1 waves-effect waves-light btn" type="submit" value="Guardar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>