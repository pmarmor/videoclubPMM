<?php
if (isset($_SESSION['usuario']) ){
        $usuario=$_SESSION['usuario'];
        $contraseña=$_SESSION['contraseña'];
    }
else{  die(header('Location: index.php'));}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Main</title>
</head>
<body>
<p>Hola <?php echo $usuario.'<br>';?>
</p>
<?php if (isset($vc)){
    echo "SOPORTES ALQUILADOS<br>--------------";
    $array= $vc->getAlquileres($usuario);
    if ($array==null){
        echo "<br>No hay soportes alquilados<br><br>";
    }
    foreach ($array as $element){
        echo $element->muestraResumen();
        echo "<br>--------------";
    }
} ?>
<form action="logout.php" method="get">
    <input type="submit" value="Cerrar sesión" name="logout">
</form>
</body>
</html>
