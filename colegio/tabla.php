<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Acceso a base de datos</title>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css"> 
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function(){
    $('#myTable').DataTable( {
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
     
});
</script>
</head>

<body style="margin:.2rem;">
<h1> Base de datos Sensual</h1>
<?php


	
	$db = new PDO("mysql:host=localhost;dbname=colegio;", "root", "Akessa2684");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
	$sql = "SELECT * FROM alumno";
	
	try {
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}
	
	//var_dump($result->fetch_assoc());
	//var_dump($result->fetch_assoc());
	
	$primeraFila = $st->fetch(PDO::FETCH_ASSOC);
	$nombreColumnas = array_keys($primeraFila);
	echo '<table id="myTable" class="display">';
	echo '<thead>';
	echo '<tr>';
	foreach ($nombreColumnas as $nombreColumna) {
		echo '<td>' . $nombreColumna . '</td>';	
	}
	echo '</tr>';
	echo '</thead>';
	
	echo '<tbody>';
	echo '<tr>';
        
        var_dump ($primeraFila);
        
	foreach ($primeraFila as $elementoPrimeraFila) {
		echo '<td>' . $elementoPrimeraFila . '</td>';	
                
	}
	echo '</tr>';
	
	while ($fila = $st->fetch(PDO::FETCH_ASSOC)) {
		//echo $fila['nombre'] . ' ' . $fila['apellidos'];
		
		
		echo '<tr>';
		echo '<td>' . $fila['id'] . '</td>';
		echo '<td>' . $fila['curso_id'] . '</td>';
		echo '<td>' . $fila['nombre'] . '</td>';
		echo '<td>' . $fila['apellidos'] . '</td>';
		echo '<td>' . $fila['fecha_nacimiento'] . '</td>';
		echo '<td>' . $fila['nif'] . '</td>';
                echo '<td>' . $fila['nota'] . '</td>';
		echo '<td><img src="uploads/' . $fila['foto'] . '"></td>'; 
		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	
	
?>
<h2>Introduzca aqui los datos a subir</h2>

<?php
// con esto conectas a la base de datos
	$db = new PDO("mysql:host=localhost;dbname=colegio;", "root", "Akessa2684");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
	$sql = "SELECT * FROM provincia";
	
	try {
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}
	
	
	echo '<select>';
	while ($fila = $st->fetch(PDO::FETCH_ASSOC)) {
		echo '<option>' . $fila['nombre'] . '</option>';	
	}
	echo '</select>';
	//con esto cierras conexion con la base de datos
	
?>

<h2>Rellena para introducir alumno</h2>

<form action="nuevo_alumno.php" method="post">

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
    
    <input type="submit" value="Enviar">

</form>

</body>
</html>