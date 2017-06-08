<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Acceso a base de datos</title>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</head>

<body style="margin:.2rem;">
<h1> Base de datos Sensual</h1>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

        $db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8", "root", "Akessa2684");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) FROM alumno";
        try {
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	}
       
       
			
	 $totalAlumnos = $st->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
      //  var_dump ($totalAlumnos);
         //paginacion
        $filasPorPagina = 3;
        $numeroPaginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $offset = ($numeroPaginaActual -1) * $filasPorPagina;
        
        $columnaOrden = isset($_GET['columna_orden']) ? $_GET['columna_orden'] : 'nombre';
        $ordenLista = isset($_GET['orden']) ? $_GET['orden'] : 'asc';
	$sql = "SELECT * FROM alumno
                ORDER BY " . $columnaOrden . ' ' . $ordenLista ."
                 LIMIT " .  $filasPorPagina . ' OFFSET ' . $offset; 
        $numeroPaginas = $totalAlumnos / $filasPorPagina;
        //var_dump (ceil($numeroPaginas));
	
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
        ?>
	<table id="myTable" class="display">
	<thead>
	<tr>
	<?php foreach ($primeraFila as $nombreColumna => $datoPrimeraFila) { ?>
        <?php
            if ($nombreColumna == $columnaOrden)  {
                $ordenEnlace = $ordenLista == 'asc' ? 'desc' : 'asc';
            }else {
                $ordenEnlace = 'asc';
            }
           $parametrosUrl = 'columna_orden=' . $nombreColumna . '&' . 'orden=' . $ordenEnlace;
           ?>
            <th>
                <a href="lista_alumno_sin_datatables.php?<?php echo $parametrosUrl ?>">
                    <?php echo $nombreColumna ?>
                </a>
            </th>
             
        <?php } ?>
             
	</tr>
	</thead>
        
	
	<tbody>
	<tr>
        
        <?php 
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
	
        for($i=1; $i<=ceil($numeroPaginas); $i++) {
            echo '<a href="lista_alumno_sin_datatables.php?pagina=' . $i . '&' . 'columna_orden=' . $columnaOrden . '&' . 'orden=' . $ordenLista . '">' . $i . '</a>'; 
        }
	
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