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

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
		
		.dib1  {  position: absolute; left: 1060px; top: 35px; width: 65px; height: 45px; }

</style> 

<body>
<img src="imagenes/pantalla.jpg" width="900" height="114" alt="imagen" />
<a href="index.html"> <img src="imagenes/atras.jpg"  class="dib1" ></a>

<div  style="text-align:justify" id="target">
<center><h3>AGREGAR VIDEOJUEGO</h3></center>



<p>&nbsp;</p>
<form id="Formulario" name="Formulario" method="post" action="Agregar_Videojuego.php">
  <table width="400" border="1">
    <tr>
      <td>Nombre</td>
      <td><input type="text" name="Nombre" id="Nombre" /></td>
    </tr>
    <tr>
      <td>Desarrollador</td>
      <td>
      <select name="Desarrollador" id="Desarrollador">
      <?php
	  	$sql_desarrollador="SELECT * FROM desarrollador";
      $resultado_desarrollador=oci_parse($conexion, $sql_desarrollador); // oci_parse es equivalente a mysql_query (Pero los parametros van al reves)
      oci_execute($resultado_desarrollador);
      while($fila_desarrollador=oci_fetch_array($resultado_desarrollador)) //OCI_BOTH es el predeterminado
      {
      ?>
        	<option value="<?php echo $fila_desarrollador["ID_DESARROLLADOR"]; ?>" ><?php echo $fila_desarrollador["NOMBRE_DESARROLLADOR"]; ?></option>
        <?php
		  }
		
	    ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Editor</td>
      <td>
      <select name="Editor" id="Editor">
      <?php
	  	$sql_editor="SELECT * FROM editor";
      $resultado_editor=oci_parse($conexion, $sql_editor); // oci_parse es equivalente a mysql_query (Pero los parametros van al reves)
      oci_execute($resultado_editor);
      while($fila_editor=oci_fetch_array($resultado_editor)) //OCI_BOTH es el predeterminado
      {
      ?>
        	<option value="<?php echo $fila_editor["ID_EDITOR"]; ?>" ><?php echo $fila_editor["NOMBRE_EDITOR"]; ?></option>
        <?php
		  }
		
	    ?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Precio</td>
      <td><input sty type="number" name="Precio" id="Precio"/></td>
    </tr>
    <tr>
      <td>Fecha de lanzamiento</td>
      <td><input type="date" name="Fecha_Lanzamiento" id="Fecha_Lanzamiento" /></td>
    </tr>
    <tr>
      <td>Sinopsis</td>
      <td><textarea name="Sinopsis" id="Sinopsis" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>Clasificacion</td>
      <td><select name="Clasificacion" id="Clasificacion">
        <option value="E">Todos</option>
        <option value="E10+">Todos +10</option>
        <option value="T">Adolescentes</option>
        <option value="M17">Maduro +17</option>
        <option value="A">Adultos ünicamente +18</option>
        <option value="RP">Aún sin clasificar</option>
      </select></td>
    </tr>
    <tr>
      <td>Idioma</td>
      <td><select name="Idioma" id="Idioma">
        <option value="1">Inglés</option>
        <option value="2">Español</option>
        <option value="3">Japonés</option>
        <option value="4">Chino</option>
        <option value="5">Coreano</option>
        <option value="6">Francés</option>
        <option value="7">Italiano</option>
      </select></td>
    </tr>
	<tr>
      <td>Genero</td>
      <td><select name="Genero" id="Genero">
        <option value="1">Mundo Abierto</option>
        <option value="2">Acción</option>
        <option value="3">Multijugador</option>
        <option value="4">Arcade</option>
        <option value="5">Aventura</option>
        <option value="6">Sobrenatural</option>
      </select></td>
    </tr>
    <tr>
      <td>Multimedia</td>
      <td><input type="text"  name="Archivo" id="Archivo" value=""/><div id="upload_button">Buscar</div></td>
    </tr>
  </table>
  <p>
    <label>
      <input type="submit" name="Enviar" id="Enviar" value="Enviar" />
    </label>
  </p>
  </div>
</form>
<p>&nbsp;</p>
</body>
</html>

