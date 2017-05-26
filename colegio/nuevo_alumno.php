<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Documento sin título</title>
</head>

<body>
<?php


// con esto conectas a la base de datos
		$db = new PDO("mysql:host=localhost;dbname=colegio;", "root", "Akessa2684");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $nombreArchivo = md5(uniqid());
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);


	var_dump($_FILES);
	move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $nombreArchivo . '.' . $ext);
	
        //Con esto recoges el dato nombre y apellidos del formulario y lo introduce en la base datos alumnos
	$sql = "INSERT INTO alumno (curso_id, nombre, apellidos, fecha_nacimiento, nif, nota, foto) VALUES ('" . $_POST["curso"] . "','" . $_POST["nombre"] . "','" . $_POST["apellidos"] . "','" . date("Y-m-d", strtotime($_POST["fecha_nacimiento"])) . "','"  . $_POST["nif"] . "','" . $_POST["nota"] . "','" . $nombreArchivo . '.' . $ext . "')";
        
	try {
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}

        
	?>
</body>
</html>