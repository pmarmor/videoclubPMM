<?php
include ("autoload.php");
use app\Videoclub;
session_start();

if (!isset($_SESSION['usuario'])){
    die(header("Location: index.php"));
}
if (isset($_SESSION['usuario'])!="admin"){
    die(header("Location: index.php"));
}

$nombre=$_POST["nombre"];
$usuario=$_POST["usuario"];
$contraseña=$_POST["paswd"];
$alquileres=$_POST["maxAlq"];
$posicion=$_SESSION['posicion'];
if (isset($_SESSION['videoclub'])){
    $vc=unserialize($_SESSION['videoclub']);
    $vc->socios[$posicion]->setNombre($nombre);
    $vc->socios[$posicion]->setContraseña($contraseña);
    $vc->socios[$posicion]->setMaxAlquilerConcurrente($alquileres);
    $vc->socios[$posicion]->setUsuario($usuario);
    $_SESSION['videoclub']=serialize($vc);
    if (isset($_SESSION['sesionAdmin'])){
        if ($_SESSION['sesionAdmin']==true){
           die( header("Location: mainAdmin.php"));
        }
    }
    $_SESSION['usuario']=$usuario;
    $_SESSION['nombre']=$nombre;
    header("Location: main.php");
}