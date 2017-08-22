<?php session_start();?>
<?php $title="historial"?>
<?php
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
$menuhistorial="active";
?>
    <!doctype html>
    <html>

    <head>

        <meta charset="utf-8">
        <title>
            <?php echo $title; ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->

        <title>Gran Misión Vivienda Venezuela</title>
        <?php
	include("head.php");
	
	?>
    </head>

    <body>
        <?php
	include('navegacion.php');
	?>
       <br>
        <div class="row">
            <nav>
                <div class="color-antv-4 nav-wrapper">
                    <a href="#" class="brand-logo">Listado De Historial De Usuarios</a>
                </div>
            </nav>
            <table class="highlight margin-table" id="Jtabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Usuario</th>
                        <th class='hidden-350'>Evento</th>
                        <th class='hidden-1024'>Fecha</th>
                        <th class='hidden-480'>Hora</th>
                        <th></th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                                        $historial_usuario=mysql_query("SELECT * FROM historial order by fecha");
                                        while ($consulta=mysql_fetch_array($historial_usuario)){

                                        ?>

                        <tr>
                            <td>
                                <?php echo $consulta['ide_historial']; ?>
                            </td>
                            <td>
                                <?php echo $consulta['usuario']; ?>
                            </td>
                            <td>
                                <?php echo $consulta['evento']; ?>
                            </td>
                            <td>
                                <?php echo $consulta['fecha']; ?>
                            </td>
                            <td>
                                <?php echo $consulta['hora']; ?>
                            </td>



                            </td>
                            <td>
                                <p>


                            </td>

                        </tr>

                        <?php
                                        }
                                        ?>
                </tbody>
            </table>
        </div>



    </body>

    </html>