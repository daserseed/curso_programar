<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Documento sin título</title>
</head>

<body>
<?php
// con esto conectas a la base de datos
	$conn = new mysqli("localhost", "root", "Akessa2684", "colegio");
	//Con esto recoges el dato nombre y apellidos del formulario y lo introduce en la base datos alumnos
	$sql = "INSERT INTO alumno (nombre, apellidos, fecha_nacimiento, nif, nota) VALUES ('" . $_POST["nombre"] . "','" . $_POST["apellidos"] . "','" . $_POST["fecha_nacimiento"] . "','"  . $_POST["nif"] . "','" . $_POST["nota"] . "')";
	$conn->query($sql);
	//con esto cierras conexion con la base de datos
	$conn->close();
	
	?>
</body>
</html>