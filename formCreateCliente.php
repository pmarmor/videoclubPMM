<?php
session_start();
if (!isset($_SESSION['usuario'])){
    die(header("Location: index.php"));
}
if (isset($_SESSION['usuario'])!="admin"){
    die(header("Location: index.php"));
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
<form action="createCliente.php" method="post">
    <table>
        <tr>
            <td>Nombre</td> <td><input type="text" name="nombre"></td>
        </tr>
        <tr>
            <td>Usuario</td> <td><input type="text" name="usuario"></td>
        </tr>
        <tr>
            <td>Contraseña</td> <td><input type="text" name="paswd"></td>
        </tr>
        <tr>
            <td>Alquileres permitidos</td> <td><input type="number" name="maxAlq" min="0"></td>
        </tr>
    </table>
    <input type="submit">
</form>
<form action="mainAdmin.php" method="post">
    <input type="submit" value="Volver"">
</form>
</body>
</html>


