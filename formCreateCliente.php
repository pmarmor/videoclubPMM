<?php
if (!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
if (!$_SESSION['usuario']=="admin"){
    header("Location: index.php");
}
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
<form action="" method="post">
    <div>Nombre<input type="text"></div>
    <div>Usuario<input type="text"></div>
    <div>Contraseña<input type="text"></div>
    <div>Alquileres permitidos <input type="number" min="0"></div>
</form>
</body>
</html>


