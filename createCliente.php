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
    $array=$vc->getSocios();
    $existe=false;
    foreach ($array as $socio){
        if ($socio->getUsuario()== $usuario ){
            $existe=true;
        }
    }
    if ($existe){
        $error='El usuario ya existe';
        die( include("mainAdmin.php"));
    }
    $vc->incluirSocio($nombre, $alquileres,$contraseña,$usuario);
    if ($file = fopen("credenciales.txt", "a")) {
        $usuario=$usuario.",".$contraseña."\n";
        fwrite($file, $usuario);
        fclose($file);
    }

    $_SESSION['videoclub']=serialize($vc);
    header("Location: mainAdmin.php");
}

/**
 * LEE EL FICHERO "USUARIOS.TXT" Y DEVUELVE UN ARRAY CON TODOS LOS DATOS
 * @return array
 */
function leeFichero()
{
    $usuarios = array();
    if ($file = fopen("credenciales.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            $str_arr = explode(",", $line);
            $usuarios[$str_arr[0]] = $str_arr[1];


        }
        fclose($file);
    }
    return $usuarios;
}
