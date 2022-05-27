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
	include("Funciones.php");
	$ID=$_GET['id'];
	
	$sql_vg = "DELETE FROM VIDEOJUEGO_GENERO WHERE ID_VIDEOJUEGO='$ID'";
	$stm = oci_parse($conexion,$sql_vg);
	oci_execute($stm);

	$sql_videojuego="DELETE FROM VIDEOJUEGO WHERE ID_VIDEOJUEGO='$ID'";
	
	$stm = oci_parse($conexion,$sql_videojuego);
		
	oci_execute($stm);
	
	if(!oci_error())
	{
		echo "<center><h1>Registro Eliminado<br><a href='index.html'>INICIO</a></h1></center>";	
	}
	else
	{
		echo "<center>Error al Eliminar</center>";	
	}
		
?>
</body>
</html>