<?php

include("autoload.php");

use app\Videoclub;

session_start();

if (!isset($_SESSION['usuario'])) {
    die(header("Location: index.php"));
}
if (isset($_SESSION['usuario']) != "admin") {
    die(header("Location: index.php"));
}

$nombre = $_POST["nombre"];
$usuario = $_POST["usuario"];
$contraseña = $_POST["paswd"];
$alquileres = $_POST["maxAlq"];
$posicion = $_SESSION['posicion'];
if (isset($_SESSION['videoclub'])) {
    $vc = unserialize($_SESSION['videoclub']);
    $socios=$vc->getSocios();
    $existe=false;
    $_SESSION["posicion"]=0; //posición del usuario en el array
    $i=0;//contador en foreach
    foreach ( $socios as $socio){

        if($socio->getUsuario() == $usuario){
            $existe=true;
            unset($vc->socios[$i]);
            break;
        }
        $i=$i+1;
    }
    $_SESSION['videoclub']=serialize($vc);
    if (isset($_SESSION['sesionAdmin'])) {
        if ($_SESSION['sesionAdmin'] == true) {
            die(header("Location: mainAdmin.php"));
        }
    }
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nombre'] = $nombre;
    header("Location: main.php");
}