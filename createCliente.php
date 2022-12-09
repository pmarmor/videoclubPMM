<?php
include ("autoload.php");
use app\Videoclub;
session_start();
$nombre=$_POST["nombre"];
$usuario=$_POST["usuario"];
$contraseña=$_POST["paswd"];
$alquileres=$_POST["maxAlq"];

if (isset($_SESSION['videoclub'])){
    $vc=unserialize($_SESSION['videoclub']);
    $vc->incluirSocio($nombre, $alquileres,$contraseña,$usuario);
    $_SESSION['videoclub']=serialize($vc);
    header("Location: mainAdmin.php");
}

