<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>METER A BASES DE DATOS</title>
</head>

<body>
<?php
	echo "añadido";
	//var_dump($_GET);
	
	// con esto conectas a la base de datos
	$conn = new mysqli("localhost", "root", "Akessa2684", "colegio");
	//Con esto recoges el dato nombre y apellidos del formulario y lo introduce en la base datos alumnos
	$sql = "INSERT INTO alumno (nombre, apellidos) VALUES ('" . $_POST["nombre"] . "','" . $_POST["apellidos"] . "')";
	$conn->query($sql);
	//con esto cierras conexion con la base de datos
	$conn->close();
	
	var_dump($_FILES);
	move_uploaded_file($_FILES['foto']['tmp_name'], 'tmp/imagen_subida.jpg');
	
?>

</body>
</html>