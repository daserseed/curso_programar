<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>ç
        <?php
      $db = new PDO("mysql:host=localhost;dbname=colegio;", "root", "Akessa2684");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO contacto
                (nombre, email)
                VALUES
                (?, ?)
                ";
        
        try {
          $st = $db->prepare($sql);
          $st->execute(array ($_POST['nombre'], $_POST['email']));
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
        
        ?>
    </body>
</html>
