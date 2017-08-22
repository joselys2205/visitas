<?php
$conectar=mysql_connect("localhost","root","");
mysql_set_charset("utf8", $conectar);
mysql_select_db("seguridad");

date_default_timezone_set("America/Caracas");

?>