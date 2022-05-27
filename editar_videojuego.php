<?PHP include("Funciones.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>menu</title>

<style type="text/css">
<!--
body {
	background-image: url();
	background-repeat: no-repeat;
	background-color: #333333;
}
-->
</style></head>

<body>
<?php

	$ID = $_POST['ID']; 
	$NOMBRE = $_POST['NOMBRE'];
	$PRECIO = $_POST['PRECIO'];
	$FECHA_LANZAMIENTO = $_POST['FECHA_LANZAMIENTO'];
	$SINOPSIS = $_POST['SINOPSIS'];
	$Clasificacion = $_POST['CLASIFICACION'];
	$IDIOMA = $_POST['IDIOMA'];
	$TRAILER = $_POST['TRAILER'];
	$fechlan = "TO_DATE('" . $FECHA_LANZAMIENTO . "', 'yyyy-mm-dd')";


	$sql_pelicula = "UPDATE VIDEOJUEGO SET NOMBRE='$NOMBRE', PRECIO=$PRECIO, FECHA_LANZAMIENTO=$fechlan, SINOPSIS='$SINOPSIS', CLASIFICACION='$Clasificacion', ID_IDIOMA='$IDIOMA', TRAILER='$TRAILER' WHERE ID_VIDEOJUEGO='$ID'";
	
	$stm = oci_parse($conexion,$sql_pelicula);
		
	oci_execute($stm);
	
	if(!oci_error())
	{
		echo "<center><h1>Registro Actualizado<br><a href='index.html'>INICIO</a></h1></center>";	
	}
	else
	{
		echo "<center>Error al Registrar</center>";	
	}

?>
</body>
</html>

