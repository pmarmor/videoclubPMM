<?php
session_start();
if (isset($_SESSION['login'])){
    die(header('Location: main.php'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Document</title>
</head>
<body>
<fieldset>
    <legend>Iniciar sesión</legend>
    <form action="login.php" method="post">
        <label>Usuario:</label>
        <input type="text" id="usuario" name="usuario"><br><br>
        <label for>Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña"><br><br>
        <input type="submit" name="boton" id="boton">
    </form>
</fieldset>
<div id="error"><?php
    if (isset($error)){echo $error;} ?></div>
</body>
</html>