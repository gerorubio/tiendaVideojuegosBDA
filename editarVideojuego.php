<?php 
	$id=$_GET['id'];
?>

<?PHP include("Funciones.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>menu</title>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/AjaxUpload.2.0.min.js"></script>
<script language="javascript">
	$(document).ready(function(){
	var button = $("#upload_button"), interval;
	new AjaxUpload("#upload_button", {
        action: "ajax/TIP_Subir.php",
		onSubmit : function(file , ext){
			if (! (ext && /^(mp4|avi|mp3|txt|jpg|png)$/.test(ext))){	//Solo se permititen archivos de tipo: mp4, avi, mp3, txt, jpg, png
				alert("Solo se permiten archivos de tipo: mp4, avi, mp3, txt, jpg o png");
				return false;	//Cancela la carga
			} else {
				button.text("Cargando");
				this.disable();
			}
		},
		onComplete: function(file, response){
			button.text("Buscar");
			this.enable();	//Habilita el bot�n Subir
			alert ("Archivo Cargado");	
			$('#Archivo').val(response);
		}
	});
});
</script>
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
			style="text-align:justify;

		} 
		
		.dib1  {  position: absolute; left: 1060px; top: 35px; width: 65px; height: 45px; }

</style> 

<body>
<img src="imagenes/pantalla.jpg" width="900" height="114" alt="imagen" />
<a href="index.html"> <img src="imagenes/atras.jpg"  class="dib1" ></a>

<div  style="text-align:justify" id="target">
<center><h3>EDITAR VIDEOJUEGO</h3></center>

<?php
	$sql_paciente="SELECT V.NOMBRE, V.PRECIO, V.FECHA_LANZAMIENTO, V.SINOPSIS, V.CLASIFICACION, V.TRAILER, V.ID_IDIOMA
    FROM VIDEOJUEGO V
    WHERE ID_VIDEOJUEGO='$id'";
    // SELECT V.NOMBRE, V.SINOPSIS, V.PROMOCION, C.CLASIFICACION, C.DESCRIPCION, P.VIDEO
	// FROM PELICULA P
	// JOIN CLASIFICACION C
	// ON C.CLASIFICACION= P.CLASIFICACION
 	// WHERE ID_PELICULA='$id'";
	$resultado_paciente=oci_parse($conexion,$sql_paciente);
	oci_execute($resultado_paciente);
	while( $fila_paciente = oci_fetch_array($resultado_paciente, OCI_RETURN_LOBS))  // OCI_BOTH OCI_NUM  OCI_ASSOC OCI_RETURN_NULLS   OCI_ASSOC+OCI_RETURN_NULLS  OCI_RETURN_LOBS
	{
?>

<p>&nbsp;</p>
<form id="Formulario" name="Formulario" method="post" action="editar_videojuego.php">
  <table width="500" border="1">
	<tr>
      <td>ID</td>
      <td><input type="text" name="ID" id="ID" value="<?php echo $id;?>" readonly/></td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td><input type="text" name="NOMBRE" id="NOMBRE" value="<?php echo $fila_paciente['NOMBRE'];?>" size=50/></td>
    </tr>
	<tr>
      <td>Precio</td>
      <td><input type="number" name="PRECIO" id="PRECIO" value="<?php echo $fila_paciente['PRECIO'];?>" size=50/></td>
    </tr>
	<tr>
      <td>Fecha de lanzamiento</td>
      <td><input type="date" name="FECHA_LANZAMIENTO" id="FECHA_LANZAMIENTO" size=50/></td>
    </tr>
    <tr>
      <td>Sinopsis</td>
      <td><input type="textarea" name="SINOPSIS" id="SINOPSIS" value="<?php echo $fila_paciente['SINOPSIS'];?>" size=50/></td>
    </tr>
	<tr>
      <td>Clasificacion</td>
      <td><select name="CLASIFICACION" id="CLASIFICACION">
        <option value='E' <?php if($fila_paciente['CLASIFICACION'] == 'E'){echo("selected");}?> >Todos</option>
        <option value='E10+' <?php if($fila_paciente['CLASIFICACION'] == 'E10+'){echo("selected");}?> >Todos +10</option>
        <option value='T' <?php if($fila_paciente['CLASIFICACION'] == 'T'){echo("selected");}?> >Adolescentes</option>
        <option value='M17' <?php if($fila_paciente['CLASIFICACION'] == 'M17'){echo("selected");}?>>Maduro +17</option>
        <option value='A' <?php if($fila_paciente['CLASIFICACION'] == 'A'){echo("selected");}?>>Adultos ünicamente +18</option>
        <option value='RP' <?php if($fila_paciente['CLASIFICACION'] == 'RP'){echo("selected");}?>>Aún sin clasificar</option>
      </select></td>
    </tr>
	<tr>
      <td>Idioma</td>
      <td><select name="IDIOMA" id="IDIOMA">
        <option value=1 <?php if($fila_paciente['ID_IDIOMA'] == '1'){echo("selected");}?>>Inglés</option>
        <option value=2 <?php if($fila_paciente['ID_IDIOMA'] == '2'){echo("selected");}?>>Español</option>
        <option value=3 <?php if($fila_paciente['ID_IDIOMA'] == '3'){echo("selected");}?>>Japonés</option>
        <option value=4 <?php if($fila_paciente['ID_IDIOMA'] == '4'){echo("selected");}?>>Chino</option>
        <option value=5 <?php if($fila_paciente['ID_IDIOMA'] == '5'){echo("selected");}?>>Coreano</option>
        <option value=6 <?php if($fila_paciente['ID_IDIOMA'] == '6'){echo("selected");}?>>Francés</option>
        <option value=7 <?php if($fila_paciente['ID_IDIOMA'] == '7'){echo("selected");}?>>Italiano</option>
      </select></td>
    </tr>
    <tr>
      <td>Multimedia</td>
      <td><input type="text"  name="TRAILER" id="TRAILER" value="<?php echo $fila_paciente["TRAILER"];?>"/><div id="upload_button">Buscar</div></td>
    </tr>
    </table>
	<p>
      <?php
	}
    ?>
    <label>
      <input type="submit" name="Enviar" id="Enviar" value="Enviar" />
    </label>
  </p>
  </div>
</form>
<p>&nbsp;</p>	
</body>
</html>

