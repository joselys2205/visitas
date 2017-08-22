<nav>
    <div class="color-antv-2 nav-wrapper">
        <img class="logo-antv" src="../img/logo-nuevo.png" alt="">
        <a href="#!" class="brand-logo">Sistema de Control y Acceso</a>
        <ul class="right hide-on-med-and-down">
            <li class='<?php echo $menuinicio;?>'><a href="../admin/index.php">Inicio</a></li>
            <li class='<?php echo $menupersonal;?>'><a href="gestionar_personal.php">Personal</a></li>
            <li class='<?php echo $menuvisitas;?>'><a class="dropdown-button" href="#!" data-activates="dropdown1">Visitas<i class="material-icons right">arrow_drop_down</i></a></li>
            <li class='<?php echo $menugestionarusuario;?>'><a href="gestionar_usuario.php">Gestionar Usuario</a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown2"> ¡ Hola</b></font> <?php echo $nombre.'!';?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>

<ul id="dropdown1" class="dropdown-content">
    <li><a href="visitas.php">Listado de visitas</a></li>
    <li><a href="visitas_existentes.php">Visitas Existentes</a></li>
</ul>

<ul id="dropdown2" class="dropdown-content">
    <li class='<?php echo $menuconfiguracion;?>'><a href="configuracion.php">Configuración</a></li>
    <li class='<?php echo $menuhistorial;?>'><a href="historial.php">Historial Usuario</a></li>
    <li><a href="../cerrar.php">Cerrar Sesión</a></li>
</ul>


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