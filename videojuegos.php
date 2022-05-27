<?php include("Funciones.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
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

		<style> 
		#target { 
			font: Verdana, Geneva, sans-serif; 
			color: #FFFFFF;
            text-align:center;			

		} 
		
				#targeta { 
			font: Verdana, Geneva, sans-serif; 
			color: #FFFFFF; 
			text-align:justify;

		} 
		
		.dib1  {  position: absolute; left: 1060px; top: 35px; width: 65px; height: 45px; }

</style> 

<body>
<img src="imagenes/pantalla.jpg" width="929" height="114" alt="imagen" />

<a href="index.html"> <img src="imagenes/atras.jpg"  class="dib1" ></a>

<table width="70%" border="1" >
	<tr>
    	<th id="target">Id Videojuego</th>
        <th id="target">Nombre</th>
		<th id="target">Editor</th>
        <th id="target">Desarrollador</th>
        <th id="target">Precio</th>
        <th id="target">Fecha de lanzamiento</th>
        <th id="target">Sinopsis</th>
        <th id="target">Clasificacion</th>
        <th id="target">Multimedia</th>
        <th id="target">Genero</th>
        <th id="target">Idioma</th>
        <th id="target">Eliminar</th>
        <th id="target">Actualizar</th>
    </tr>
<?php
	$sql_videojuego="SELECT V.ID_VIDEOJUEGO, E.NOMBRE_EDITOR, D.NOMBRE_DESARROLLADOR, V.NOMBRE, V.PRECIO, V.FECHA_LANZAMIENTO, V.SINOPSIS, V.CLASIFICACION, V.TRAILER, I.NOMBRE_IDIOMA
	FROM VIDEOJUEGO V
	JOIN EDITOR E
	ON E.ID_EDITOR=V.ID_EDITOR
	JOIN DESARROLLADOR D
	ON D.ID_DESARROLLADOR=V.ID_DESARROLLADOR
	JOIN IDIOMA I
	ON I.ID_IDIOMA=V.ID_IDIOMA
	ORDER BY ID_VIDEOJUEGO ASC";
	$resultado_videojuego=oci_parse($conexion,$sql_videojuego);
	oci_execute($resultado_videojuego);
	while( $fila_videojuego = oci_fetch_array($resultado_videojuego, OCI_RETURN_LOBS))  // OCI_BOTH OCI_NUM  OCI_ASSOC OCI_RETURN_NULLS   OCI_ASSOC+OCI_RETURN_NULLS  OCI_RETURN_LOBS
	{
?>
	<tr  id="target">
		
		<td><?php echo $fila_videojuego['ID_VIDEOJUEGO']; ?></td>
        <td><?php echo $fila_videojuego["NOMBRE"]; ?></td>
		<td><?php echo $fila_videojuego["NOMBRE_EDITOR"]; ?></td>
        <td><?php echo $fila_videojuego["NOMBRE_DESARROLLADOR"]; ?></td>
        <td><?php echo $fila_videojuego["PRECIO"]; ?></td>
        <td><?php echo $fila_videojuego["FECHA_LANZAMIENTO"]; ?></td>
        <td WIDTH="500"><?php echo $fila_videojuego["SINOPSIS"]; ?></td>
        <td><?php echo $fila_videojuego["CLASIFICACION"]; ?></td>
	
        <td WIDTH="401"
	    HEIGHT="249" id="targeta">
		
		<?php
		$archivos = $fila_videojuego["TRAILER"]; 
		$trozos = explode(".", $archivos); 
		$extension = end($trozos); 
	   
		if( $extension == "avi" || $extension == "mp4"  ) {
		?>
		<video width="401" height="249" controls>
			<source src="videojuego/<?php echo $fila_videojuego["TRAILER"];?>"  type="video/mp4" /> 
		</video>
			
		<?php
			} 
			if( $extension == "mp3")
				{ ?>
				<audio controls>
					<source src="videojuego/<?php echo $fila_videojuego["TRAILER"];?>" type="audio/mpeg" />
				</audio>
					 
		<?php	
		}
		?>
		<div style="text-align:justify">
			<?php	
				if( $extension == "txt")
				{
					 $ar=fopen("videojuego/$archivos","r") or
				die("No se pudo abrir el archivo");
			  while (!feof($ar))
			  {
				$linea=fgets($ar);
				$lineasalto=nl2br($linea);
				echo $lineasalto;
			  }
			  fclose($ar);
}
			?>
			<?php	
		if( $extension == "jpg" || $extension == "png" )
				{
		?>
		<div align="center">
			<img src="videojuego/<?php echo $fila_videojuego["TRAILER"];?>" alt="Imagen no disponible"> </div>
			<?php	
		}
		?>
		</div> 
		
		<td>
			<?php
				$id_genero = $fila_videojuego['ID_VIDEOJUEGO'];
				$sql_genero="SELECT G.NOMBRE_GENERO, VG.ID_VIDEOJUEGO
				FROM GENERO G
				JOIN VIDEOJUEGO_GENERO VG
				ON VG.ID_GENERO=G.ID_GENERO
				WHERE VG.ID_VIDEOJUEGO='$id_genero'
				ORDER BY G.ID_GENERO ASC";
				$resultado_genero=oci_parse($conexion,$sql_genero);
				oci_execute($resultado_genero);
				while( $fila_genero = oci_fetch_array($resultado_genero, OCI_RETURN_LOBS)) {
					echo "<p>" . $fila_genero["NOMBRE_GENERO"] . "</p>";
				}
			?>
		</td>
        <td><?php echo $fila_videojuego["NOMBRE_IDIOMA"]; ?></td>

		<td>
		<?php echo "<center><a href='eliminarVideojuego.php?id=".$fila_videojuego['ID_VIDEOJUEGO']."'>ELIMINAR</a></h1></center>";
		?>	
		</td>
		
		
		<td>
		<?php echo "<center><a href='editarVideojuego.php?id=".$fila_videojuego['ID_VIDEOJUEGO']."'>EDITAR</a></h1></center>";
		?>	
		</td>
		
		</td>
		</div> 
    </tr>	
<?php
	}
?>
</table>
</body>
</html>
