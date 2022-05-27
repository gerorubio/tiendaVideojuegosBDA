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

	$sql_maximo="SELECT MAX(id_videojuego) AS MAXIMO FROM videojuego";
	$resultado_maximo=oci_parse($conexion, $sql_maximo); //oci_parse equivalente a mysql_query
	oci_execute($resultado_maximo); //occi_execute para ejecutar la sentencia anterior
	$fila_maximo=oci_fetch_array($resultado_maximo); //OCI_BOTH es el predeterminado
	
	$siguiente = $fila_maximo["MAXIMO"]+1;
	$nomb = $_POST['Nombre'];
	$edit = $_POST['Editor'];
	$desa = $_POST['Desarrollador'];
	$prec = $_POST['Precio'];
	$fechlan = $_POST['Fecha_Lanzamiento'];
	$sinop = $_POST['Sinopsis'];
	$clasif = $_POST['Clasificacion'];
	$gene = $_POST['Genero'];
	$idiom = $_POST['Idioma'];
	$archiv = $_POST['Archivo'];
	
	$fechlan = "TO_DATE('" . $fechlan . "', 'yyyy-mm-dd')";


	$sql_videojuego="INSERT INTO videojuego (id_videojuego, nombre, precio, fecha_lanzamiento, sinopsis, clasificacion, trailer, id_editor, id_desarrollador, id_idioma) VALUES ($siguiente, '$nomb', $prec, $fechlan, '$sinop', '$clasif', '$archiv', $edit, $desa, $idiom)";
	
	$stm = oci_parse($conexion,$sql_videojuego);
	oci_execute($stm);
	
	if(!oci_error())
	{
		echo "<center>Registro Exitoso<br>  <a href='index.html'>Ver Peliculas</a></center>";	
	}
	else
	{
		echo "<center>Error al Registrar</center>";	
	}
	$sql_vg = "INSERT INTO videojuego_genero values($siguiente, $gene)";
	$stm = oci_parse($conexion,$sql_vg);
	oci_execute($stm);
	
	if(!oci_error())
	{
		echo "<center>Registro Exitoso<br>  <a href='index.html'>Ver Peliculas</a></center>";	
	}
	else
	{
		echo "<center>Error al Registrar</center>";	
	}
?>
</body>
</html>
