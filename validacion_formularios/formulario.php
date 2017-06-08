<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            span {
                color:red;
            }
        </style>
    </head>
    <body>
        <?php
            $errorNombre = $errorApellidos = $errorEmail = $errorWeb = '';
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (empty($_POST['nombre'])) {
                    $errorNombre = 'El nombre es obligatorio.';
                } else {
                $nombre = saneado($_POST['nombre']);               
                }
            
                if (empty($_POST['apellidos'])) {
                  $errorApellidos = 'Los apellidos son obligatorios.';
                } else {
                  $apellidos = saneado($_POST['apellidos']);
                }
                
                if (empty($_POST['email'])) {
                  $errorEmail = 'El email es obligatorio.';
                } else {
                  $email = saneado($_POST['email']);
                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $errorEmail = 'Formato de email no válido.';
                  }
                }
            }
            
            function saneado($valor) {
                $nuevoValor = trim($valor);
                $nuevoValor = htmlspecialchars($nuevoValor);
                return $nuevoValor;
            }
        
        ?>
        <form method="POST">
            <label><span>*</span>Nombre</label>
            <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''?>">
            <span><?php echo $errorNombre ?></span><br>
            <label><span>*</span>Apellidos</label>
            <input type="text" name="apellidos" value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : ''?>">
            <span><?php echo $errorApellidos ?></span><br>
             <label><span>*</span>Email</label>
             <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''?>">
            <span><?php echo $errorEmail ?></span><br>
            <label>Sitio Web</label>
             <input type="text" name="web" value="<?php echo isset($_POST['web']) ? $_POST['web'] : ''?>">
            <span><?php echo $errorWeb ?></span><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
