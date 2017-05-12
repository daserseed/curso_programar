<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Documento sin título</title>
<style>
	form {
		margin-left:auto;
		margin-right:auto;
		width:50%;	
	}
	form * {
	width:100%;	
	}
	
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">

</head>

<body>
<?php
// con esto conectas a la base de datos
	$conn = new mysqli("localhost", "root", "Akessa2684", "colegio");
	$sql = "SELECT * FROM provincia";
	$result = $conn->query($sql);
	echo '<select>';
	while ($fila = $result->fetch_assoc()) {
		echo '<option>' . $fila['nombre'] . '</option>';	
	}
	echo '</select>';
	//con esto cierras conexion con la base de datos
	$conn->close();
?>

<h2>Rellena para introducir alumno</h2>


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
    <input type="number" name="nota"><br>
    <input name="foto" type="file"><br>
    <input type="submit" value="Enviar">

</form>


<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/i18n/jquery.ui.datepicker-es.min.js"></script>
<script>
	$(function() {
		$("#datepicker").datepicker(
			$.datepicker.regional["es"]
		);
	});
</script>
</body>
</html>