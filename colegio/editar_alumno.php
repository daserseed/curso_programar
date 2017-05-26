<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
       <form action="nuevo_alumno.php" method="post" enctype="multipart/form-data" >

	<label>Nombre</label><br>
    <input type="text" name="nombre"><br>
    <label>Apellidos</label><br>
    <input type="text" name="apellidos"><br>
    <label>Fecha de nacimiento</label><br>
    <input id="datepicker" type="text" name="fecha_nacimiento"><br>
    <label>curso</label><br>
    <?php
	
  $db = new PDO("mysql:host=localhost;dbname=colegio;", "root", "Akessa2684");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
	$sql = "SELECT * FROM curso";
	
	try {
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}
	echo '<select name="curso">';
	while ($fila = $st->fetch(PDO::FETCH_ASSOC)) {
		echo '<option name="curso" value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';	
	}
	echo '</select>';
	
	
	?>
	<br>
     <label>NIF</label><br>
    <input type="text" name="nif"><br>
     <label>Nota</label><br>
    <input type="text" name="nota"><br>
    <input name="foto" type="file"><br>
    <input type="submit" value="Enviar">

</form>
    </body>
</html>
