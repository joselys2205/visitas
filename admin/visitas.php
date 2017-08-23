<?php
session_start();
/*esto es para saber cual usuario esta conectado*/
/*echo "<script>alert('".$_SESSION['usuario']."')</script>";*/
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
        <br>
        <div class="">
            <div class="row">
                <nav>
                    <div class="color-antv-4 nav-wrapper">
                        <a href="#" class="brand-logo">Listado de Visistas</a>
                            <div class="boton-antv fixed-action-btn horizontal ">
                                <a class="color-antv-2 btn-floating btn-large red">
                                    <i class="large material-icons">mode_edit</i>
                                </a>
                                <ul class="mini-btn">
                                    <li><a href="#add" class="btn-floating red"><i class="material-icons">add</i></a></li>
                                    <li><a href="reporte_listado_visitas_fpdf.php" target="_blank" class="btn-floating yellow darken-1"><i class="material-icons">print</i></a></li>
                                </ul>
                            </div>
                    </div>
                </nav>
<!--MODAL AÑADIR-->
    <div id="add" class="modal">
        <div class="modal-content">
            <nav>
                <div class="color-antv-1 nav-wrapper">
                    <a class="brand-logo"><i class="material-icons">search</i>Añadir Visitas</a>
                    <video class="foto right z-depth-5" id="target-1"></video>
                    <img class="foto-show foto right z-depth-5" id="target-2" src="../fotos-visitantes/default-pic.png"/>
				    <canvas class="foto-none foto right z-depth-5" id="canvas"></canvas>
                </div>
            </nav>
            <div class="row">
                <form action="#" method="POST" class="col s12">
                <input type="text" name="foto1" class="foto-none" >
                    <div class="row">
                       <br>
                        <div class="col s6">
                            <div class="col s6">
                                <a class="color-antv-1 waves-effect waves-light btn" id="tomar-foto" value="Tomar Foto">Tomar&nbsp;Foto</a>
                            </div>
                            <div class="col s6">
                                <a class="color-antv-1 waves-effect waves-light btn" id="borrar-foto">Borrar</a>
                            </div>
                        </div>
                    <input type="text" name="foto1" id="target-hidden" >
                   
                        
                        
                        <div class="input-field col s6">
                            <input type="number" name="cedula" id="first_name" class="validate" data-length="10">
                            <label for="textfield">Cedula</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="nombre" id="first_name" class="validate" required pattern="[^0-9!$%&/()=?¿*@]{1,20}$" title="No Admite caracteres especiales ni números.">
                            <label for="textfield">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="apellido" id="first_name" class="validate" required pattern="[^0-9!$%&/()=?¿*@]{1,20}$" title="No Admite caracteres especiales ni números.">
                            <label for="textfield">Apellido</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="correo" id="email" type="email" class="validate" title="No Admite caracteres especiales ni números.">
                            <label for="email" data-error="incorrecto" data-success="correcto">Correo</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="number" name="telefono" id="first_name" class="validate" data-length="12">
                            <label for="textfield">Telefono</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                                <select name="tipo">
                                    <option value="">Seleccione...</option>
                                    <option value="Personal">Personal</option>
                                    <option value="Laboral">Laboral</option>
                                </select>
                            <label for="confirmfield">Tipo de Visitas</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="fecha" id="first_name" class="datepicker">
                            <label for="confirmfield" class="active">Fecha</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                           <a id="setTimeButton" class="color-black"><input id="setTimeExample" type="text" name="hora" step="1" class="validate" ></a>
                            <label for="confirmfield" class="active">Hora Entrada</label>
                        </div>



                        <div class="input-field col s6">
                            <select class="browser-default" name="personal">
                              <option name="personal" disabled selected>Seleccione el trabajador</option>
                              <?php
                                            $verificar_personal=mysql_query("SELECT ced_usu,nom_per,ape_per FROM personal ORDER BY nom_per ASC");
                                            while ($consulta1=mysql_fetch_array($verificar_personal)){
                                          
                                        $ced_antv=$consulta1['ced_usu'];
                                        $nom_antv=$consulta1['nom_per'];
                                        $ape_antv=$consulta1['ape_per'];
                                        echo "<optgroup>";
                                        echo "<option value='".$ced_antv."'>".$nom_antv." ".$ape_antv."</option>";
                                        echo "</optgroup>";
                                                  }
                                            ?>
                            </select>
                            <label class="active">Trabajador ANTV</label>
                        </div>
                    </div>


                         <div class="row">
                        <div class="input-field col s6">
                            <textarea name="descripcion" id="textarea1" class="materialize-textarea" cols="30" rows="10"></textarea>
                            <label for="textarea1">Descripción</label>
                        </div>
                    </div>
                    <div class="modal-footer">
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
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Tipo Visitas</th>
                            <th>Fecha</th>
                            
                            <th class="section-btn"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
//                        $formulario_visitas=mysql_query("SELECT id_visi, ced_visi, nom_visi, ape_visi, tip_visi, fec_visi, hor_ent, hor_sal, personal.ced_usu, des_visi, foto, nick_usu FROM visitas INNER JOIN usuario ON visitas.ide_usu = usuario.ide_usu INNER JOIN personal ON visitas.ide_per = personal.ide_per ");


 //$formulario_visitas=mysql_query("SELECT visitas.id_visi, visitas.ced_visi, visitas.nom_visi, visitas.ape_visi, visitas.tip_visi, visitas.fec_visi, visitas.hor_ent, visitas.hor_sal, personal.ced_usu, visitas.des_visi, visitas.foto, usuario.nick_usu FROM visitas,personal,usuario where visitas.ide_per=personal.ide_per AND visitas.ide_usu=usuario.ide_usu ");
                        

                        $formulario_visitas = mysql_query("select * from visitas");

                                while ($consulta=mysql_fetch_array($formulario_visitas)){

                                ?>
    
                                <tr>
                                    <td><?php echo $consulta['id_visi']; ?></td>
                                    <td><?php echo $consulta['ced_visi']; ?></td>
                                    <td ><?php echo $consulta['nom_visi']; ?></td>
                                    <td><?php echo $consulta['ape_visi']; ?></td>
                                    <td><?php echo $consulta['tip_visi']; ?></td>
                                    <td><?php echo $consulta['fec_visi']; ?></td>
                                    
                                <td>
                                <div class="btn-gp fixed-action-btn horizontal click-to-toggle">
                                    <a class="color-antv-2 btn-floating red">
                                        <i class="material-icons">menu</i>
                                    </a>
                                    <ul class="visi-btn">
                                        <li><a href="#ver<?php echo $consulta['id_visi']; ?>" class="color-antv-4 btn-floating"><i class="material-icons">pageview</i></a></li>
                                        <li><a href="#modificar<?php echo $consulta['id_visi']; ?>" class="color-antv-1 btn-floating"><i class="material-icons">mode_edit</i></a></li>
                                        <li><a href="#eliminar<?php echo $consulta['id_visi']; ?>" class="color-antv-3 btn-floating green"><i class="material-icons">delete</i></a></li>
                                    </ul>
                                </div>
    <!--MODAL VER-->
    <div id="ver<?php echo $consulta['id_visi']; ?>" class="modal">
            <div class="modal-content">
                <nav>
                    <div class="color-antv-1 nav-wrapper">
                        <a class="brand-logo">Ver Personal</a>
                        <img class="foto right z-depth-5" src="../fotos-visitantes/<?php echo $consulta['foto'];?>">
                    </div>
                </nav>
                <div class="row">
                    <form action="#" method="POST" class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <label for="textfield">Cedula: <?php echo $consulta['ced_visi'];?></label>
                            </div>
                            <div class="input-field col s6">
                               
                                <label for="confirmfield">Nombre: <?php echo $consulta['nom_visi'];?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                
                                <label for="textfield">Apellido: <?php echo $consulta['ape_visi'];?></label>
                            </div>
                            <div class="input-field col s6">
                                
                                <label for="textfield">Tipo de visita: <?php echo $consulta['tip_visi'];?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                
                                <label for="textfield">Correo: <?php echo $consulta['ape_visi'];?></label>
                            </div>
                            <div class="input-field col s6">
                                
                                <label for="textfield">Telefono: <?php echo $consulta['tlf_visi'];?></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                
                                <label for="confirmfield">Fecha: <?php echo $consulta['fec_visi'];?></label>
                            </div>
                            <div class="input-field col s6">
                                
                                <label for="confirmfield">Hora Entrada: <?php echo $consulta['hor_ent'];?> </label>
                            </div>
                        </div>
                        <div class="row">
                        
                            <div class="input-field col s6">
                                
                                <label for="textfield">Trabajador ANTV:<?php $ced_usu = $consulta['ced_usu'];
											$consulta_personal=mysql_query("SELECT ced_usu,nom_per,ape_per FROM personal WHERE ced_usu='$ced_usu'");
											if ($verificar1=mysql_fetch_array($consulta_personal)) {

											 $nombre_per=$verificar1['nom_per'];
											 $apellido_per=$verificar1['ape_per'];

										$personal1 = $nombre_per.' '.$apellido_per;
										echo "$personal1";	}
											;?> 
                               </label>
                            </div>
                        </div>
                        <div class="row">

                       <!--     <div class="input-field col s6">
                                
                                <label for="textfield">Usuario: <?php echo $consulta['nick_usu'];?></label>
                            </div> -->

                            <div class="input-field col s6">
                                
                                <label for="textfield">Descripción: <?php echo $consulta['des_visi'];?></label>
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
    <div id="modificar<?php echo $consulta['id_visi']; ?>" class="modal">
        <div class="modal-content">
            <nav>
                <div class="color-antv-1 nav-wrapper">
                    <a class="brand-logo">Modificar Visitas</a>
                    <img class="foto right z-depth-5" src="../img/<?php echo $consulta['foto'];?>">
                </div>
            </nav>
            <div class="row">
                <form action="#" method="POST" class="col s12">
                     <div class="none input-field col s6">
                                <input type="hidden" name="idem" id="first_name" class="validate"  value="<?php echo $consulta['id_visi'];?>">
                                
                            </div>
                    <div class="row">
                       <br>
                        <div class="input-field col s6">
                            <input type="text" name="cedulam" id="first_name" class="validate" data-length="10" value="<?php echo $consulta['ced_visi'];?>">
                            <label for="textfield" class="active">Cedula</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="nombrem" id="first_name" class="validate" required  value="<?php echo $consulta['nom_visi'];?>">
                            <label for="textfield" class="active">Nombre</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="apellidom" id="first_name" class="validate" required  value="<?php echo $consulta['ape_visi'];?>">
                            <label for="textfield" class="active">Apellido</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="correom" id="email" type="email" class="validate"  value="<?php echo $consulta['corr_visi'];?>">
                            <label for="email" data-error="incorrecto" data-success="correcto" class="active">Correo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="number" name="telefonom" id="first_name" class="validate" data-length="11" value="<?php echo $consulta['tlf_visi'];?>">
                            <label for="textfield" class="active">Telefono</label>
                        </div>
                        <div class="input-field col s6">
                        <input type="text" name="tipom" id="first_name" class="validate"  required  value="<?php $tip_visi1 = $consulta['tip_visi'];
                        $consulta_tipom=mysql_query("SELECT tip_visi FROM visitas WHERE tip_visi='$tip_visi1'");
                        if ($chequearm=mysql_fetch_array($consulta_tipom)) {

                         $tipo_visita1=$chequearm['tip_visi'];
                         

                    
                    echo "$tipo_visita1";  }
                        ;?> ">

                                   
                            <label for="confirmfield" class="active">Tipo de Visitas</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="fecham" id="first_name" class="validate" value="<?php echo $consulta['fec_visi'];?>">
                            <label for="confirmfield" class="active">Fecha</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="horam"  step="1" id="first_name" class="validate" value="<?php echo $consulta['hor_ent'];?>">
                            <label for="confirmfield" class="active">Hora Entrada</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="hora1"  step="1" id="first_name" class="validate" value="<?php echo $consulta['hor_sal'];?>">
                            <label for="textfield" class="active">Hora Sálida</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="personalm" id="first_name" class="validate"  required  value="<?php $ced_usu = $consulta['ced_usu'];
                                            $consulta_personal=mysql_query("SELECT ced_usu,nom_per,ape_per FROM personal WHERE ced_usu='$ced_usu'");
                                            if ($verificar1=mysql_fetch_array($consulta_personal)) {

                                             $nombre_per=$verificar1['nom_per'];
                                             $apellido_per=$verificar1['ape_per'];

                                        $personal1 = $nombre_per.' '.$apellido_per;
                                        echo "$personal1";  }
                                            ;?> ">
                            <label for="textfield" class="active">Trabajador ANTV</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <textarea name="descripcionm" id="textarea1" class="materialize-textarea" cols="30" rows="10" value="<?php echo $consulta['des_visi'];?>"></textarea>
                            <label for="textarea1" class="active">Descripción</label>
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
    <!--MODAL ELIMINAR-->
    <div id="eliminar<?php echo $consulta['id_visi']; ?>" class="modal">
        <div class="modal-content">
                <nav>
                    <div class="color-antv-1 nav-wrapper">
                        <a class="brand-logo">Eliminar Personal</a>
                        <img class="foto right z-depth-5" src="../img/<?php echo $consulta['foto'];?>">
                    </div>
                </nav>
                <div class="row">
                    <form action="#" method="POST" class="col s12">
                         <div class="none input-field col s6">
                                <input type="hidden" name="idee" id="first_name" class="validate"  value="<?php echo $consulta['id_visi'];?>">
                                
                            </div>
                    <div class="row">
                       <br>
                        <div class="input-field col s6">
                            <input type="text" name="cedulae" id="first_name" class="validate" data-length="10" value="<?php echo $consulta['ced_visi'];?>">
                            <label for="textfield" class="active">Cedula</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="nombree" id="first_name" class="validate" required  value="<?php echo $consulta['nom_visi'];?>">
                            <label for="textfield" class="active">Nombre</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="apellidoe" id="first_name" class="validate" required  value="<?php echo $consulta['ape_visi'];?>">
                            <label for="textfield" class="active">Apellido</label>
                        </div>
                        <div class="input-field col s6">
                            <input name="correoe" id="email" type="email" class="validate" title="No Admite caracteres especiales ni números." value="<?php echo $consulta['corr_visi'];?>">
                            <label for="email" data-error="incorrecto" data-success="correcto" class="active">Correo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="number" name="telefonoe" id="first_name" class="validate" data-length="11" value="<?php echo $consulta['tlf_visi'];?>">
                            <label for="textfield" class="active">Telefono</label>
                        </div>
                        <div class="input-field col s6">
                        <input type="text" name="tipoe" id="first_name" class="validate"  required  value="<?php $tip_visi = $consulta['tip_visi'];
                        $consulta_tipo=mysql_query("SELECT tip_visi FROM visitas WHERE tip_visi='$tip_visi'");
                        if ($chequear=mysql_fetch_array($consulta_tipo)) {

                         $tipo_visita=$chequear['tip_visi'];
                         

                    
                    echo "$tipo_visita";  }
                        ;?> ">

                                   
                            <label for="confirmfield" class="active">Tipo de Visitas</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="fechae" id="first_name" class="validate" value="<?php echo $consulta['fec_visi'];?>">
                            <label for="confirmfield" class="active">Fecha</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="horae" step="1" id="first_name" class="validate" value="<?php echo $consulta['hor_ent'];?>">
                            <label for="confirmfield" class="active">Hora Entrada</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="hora1e"  step="1" id="first_name" class="validate" value="<?php echo $consulta['hor_sal'];?>">
                            <label for="textfield" class="active">Hora Sálida</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="trabajadore" id="first_name" class="validate"  required  value="<?php $ced_usu = $consulta['ced_usu'];
                                            $consulta_personal=mysql_query("SELECT ced_usu,nom_per,ape_per FROM personal WHERE ced_usu='$ced_usu'");
                                            if ($verificar1=mysql_fetch_array($consulta_personal)) {

                                             $nombre_per=$verificar1['nom_per'];
                                             $apellido_per=$verificar1['ape_per'];

                                        $personal1 = $nombre_per.' '.$apellido_per;
                                        echo "$personal1";  }
                                            ;?> ">
                            <label for="textfield" class="active">Trabajador ANTV</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <textarea name="descripcione" id="textarea1" class="materialize-textarea" cols="30" rows="10" value="<?php echo $consulta['des_visi'];?>"></textarea>
                            <label for="textarea1" class="active">Descripción</label>
                        </div>
                    </div>
<?php
       if (isset($_POST['idee'])) {
                    $idee=$_POST['idee'];
                    $cedulae=$_POST['cedulae'];
                    $nombree=$_POST['nombree'];
                    $apellidoe=$_POST['apellidoe'];
                    $tipoe=$_POST['tipoe'];
                    $correo=$_POST['correoe'];
                    $telefonoe=$_POST['telefonoe'];
                    $tipoe=$_POST['tipoe'];
                    $fechae=$_POST['fechae'];
                    $horae=$_POST['horae'];
                    $hora1e=$_POST['hora1e'];
                    $trabajare=$_POST['trabajare'];
                    $descripcione=$_POST['descripcione'];

mysql_query("DELETE FROM `visitas` WHERE `visitas`.`id_visi` = '$idee'");

echo "<script language='javascript'>alert('Su Visita Ha Sido Eliminado')</script>";
echo "<script language='javascript'>window.location='visitas.php'</script>";
}
?>
                            <div class="modal-footer">
                                <a href="#!" class="grey darken-1 modal-action modal-close waves-effect waves-light btn" value="Guardar">Cancelar</a>
                                <input type="submit" class="color-antv-3 waves-effect waves-light btn" value="Eliminar">
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
    $idem=$_POST['idem'];
    $cedulam=$_POST['cedulam'];
    $nombrem=$_POST['nombrem'];
    $apellidom=$_POST['apellidom'];
    $tipom=$_POST['tipom'];
    $correom=$_POST['correom'];
    $telefonom=$_POST['telefonom'];
    $fecham=$_POST['fecham'];
    $horam=$_POST['horam'];
    $hora1=$_POST['hora1'];
    $personalm=$_POST['personalm'];
    $descripcionm=$_POST['descripcionm'];
   
    mysql_query("UPDATE `visitas` SET `ced_visi` = '$cedulam', `nom_visi` = '$nombrem', `ape_visi` = '$apellidom', `tip_visi` = '$tipom',  `corr_visi` = '$correom',  `tlf_visi` = '$telefonom',`fec_visi` = '$fecham', `hor_ent` = '$horam', `hor_sal` = '$hora1',`ced_usu` = '$personalm', `des_visi` = '$descripcionm'  WHERE `visitas`.`id_visi` = $idem;");


echo "<script language='javascript'>alert('La visita Ha sido Modificada')</script>";
echo "<script language='javascript'>window.location='visitas.php'</script>";
}
?>

<!--CONSULTA MODIFICADA  DE AÑADIR-->
    <?php
                if (isset($_POST['cedula'])) {
                    $cedula=$_POST['cedula'];
                    $nombre=$_POST['nombre'];
                    $apellido=$_POST['apellido'];
                    $tipo=$_POST['tipo'];
                    $telefono=$_POST['telefono'];
                    $correo=$_POST['correo'];
                    $fecha=$_POST['fecha'];
                    $hora=$_POST['hora'];
                    $personal=$_POST['personal'];
                    $descripcion=$_POST['descripcion'];
                    $foto1=$_POST['foto1'];
                   
        //  VARIABLE PARA CONTENER LA INFORMACION DE LA IMAGEN
        $Base64Img = $foto1;
        //  NOMBRE DE LA IMAGEN (CEDULA DEL VISITANTE)
        $nombreImagen = $cedula;

        list(, $Base64Img) = explode(';', $Base64Img);
        list(, $Base64Img) = explode(',', $Base64Img);

        // DECODIFICACION BASE64
        $Base64Img = base64_decode($Base64Img);

        //CREACION/ACTUALIZACION DEL ARCHIVO
        file_put_contents('../fotos-visitantes/'.$nombreImagen.'.png', $Base64Img);

        // RUTA A GUARDAR EN LA BASE DE DATOS
        $foto1 = $nombreImagen.'.png';



    mysql_query("INSERT INTO `visitas` (`id_visi`, `ced_visi`, `nom_visi`, `ape_visi`, `tlf_visi`, `corr_visi`, `tip_visi`, `fec_visi`, `hor_ent`,`ced_usu`, `des_visi`, `foto`) VALUES (NULL, '$cedula','$nombre', '$apellido', '$telefono', '$correo', '$tipo', '$fecha', '$hora', '$personal', '$descripcion', '$foto1')");

                echo "<script language='javascript'>alert('Su Visita Ha Sido Añadido')</script>";
                
                echo "<script language='javascript'>window.location=('visitas.php')</script>";
                }
?>

</body>

</html>