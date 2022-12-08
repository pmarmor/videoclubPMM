<?php
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
<form action="logout.php" method="get">
    <input type="submit" value="Cerrar sesión" name="logout">
</form>
<section style="display: flex; gap: 20px">
    <div style="border: solid red 5px; padding: 5px; height: fit-content">
        <?php
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



