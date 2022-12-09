<?php
use app\Videoclub;
if (!isset($_SESSION['usuario'])){
    session_start();
    include("autoload.php");
}
if (!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
if (!$_SESSION['usuario']=="admin"){
    header("Location: index.php");
}
echo "<div style='font-size: 20px;font-weight: bold'>Hola administrador</div> <br><br>";
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
<div>
    <form action="logout.php" method="post">
        <input type="submit" value="Cerrar sesión" name="logout">
    </form>

    <form action="formCreateCliente.php" method="post">
        <input type="submit" value="Registrar a un nuevo cliente"">
    </form>
</div>
<br>
<section style="display: flex; gap: 20px">
    <div style="border: solid red 5px; padding: 5px; height: fit-content">
        <?php
        $vc=unserialize($_SESSION['videoclub']);
        if (isset($vc)) {
            echo "<td>" . $vc->listarSocios() . "</td>";
        } ?>
    </div>
    <div style="border: solid green 5px; padding: 5px">
        <?php
        if (isset($vc)) {
            echo "<td>" . $vc->listarProductos() . "</td>";
        } ?>
    </div>
</section>

</body>
</html>



