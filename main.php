<?php
include "autoload.php";
if (!isset($_SESSION['usuario'])){
    session_start();}
if (isset($_SESSION['usuario']) ){
        $nombre=$_SESSION['nombre'];
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
<p>Hola <?php echo $nombre.'<br>';?>
</p>
<form action="formUpdateCliente.php" method="post">
    <input type="submit" value="Cambiar datos">
</form>
<?php
$vc=unserialize($_SESSION['videoclub']);
if (isset($vc)){
    echo "SOPORTES ALQUILADOS<br>--------------";
    $array= $vc->getAlquileres($nombre);
    if ($array==null){
        echo "<br>No hay soportes alquilados<br><br>";
    }
    foreach ($array as $element){
        echo $element->muestraResumen();
        echo "<br>--------------";
    }
} ?>
<form action="logout.php" method="post">
    <input type="submit" value="Cerrar sesión" name="logout">
</form>
</body>
</html>
