<?php
/*CREACIÓN DE VIDEOCLUB*/
include ("autoload.php");
use app\Videoclub;
$vc = new Videoclub("Severo 8A");
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es","16:9");
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);
$vc->alquilaSocioProducto(1,2);

//
//EN CASO DE EXISTIR UN USUARIO O CONTRASEÑA, SE REALIZARÁ LA COMPROBACIÓN
if ((isset($_POST["usuario"]) || isset($_POST["contraseña"]))) {

    //EN CASO DE QUE EXISTA Y TENGA UN VALOR, SE RECIBIRÁN LOS DATOS Y SE LEERÁ EL FICHERO
    if (($_POST["usuario"] != null || $_POST["contraseña"] != null)) {
        $usuarioLogin = $_POST['usuario'];
        $contraseñaLogin = $_POST['contraseña'];

        $listaUsuarios = $vc->getSocios();
        $existe=false;
        for($i=0;$i<count($listaUsuarios);$i++){
          if ($listaUsuarios[$i]->nombre==$usuarioLogin){
              $existe=true;
          }
        }
        if ($existe==false){
            if ($usuarioLogin=="admin" && $contraseñaLogin=="admin"){
                die(include("mainAdmin.php"));
            }
            $error='El usuario no existe';
            die(include('index.php'));
        }
        $existe=false;
        for($i=0;$i<count($listaUsuarios);$i++){
            $existe=true;
        }
        if ($existe){
            if ($usuarioLogin===$contraseñaLogin){
                session_start();
                $_SESSION['usuario']=$usuarioLogin;
                $_SESSION['contraseña']=$usuarioLogin;
                $_SESSION['login']=true;
                die(header('Location: main.php'));
            }
            else{
                $error='Datos incorrectos';
                include('index.php');

            }

        }
        else{
            $error='Datos incorrectos';
            include('index.php');

        }

    }
    else{
        die(header('Location: index.php'));
    }



}
//SI SE ENTRA DIRECTAMENTE A LOGIN.PHP, SE REDIRECCIONARÁ A INDEX.PHP
else {
    echo(header('Location:index.php'));
}
/**
 * LEE EL FICHERO "USUARIOS.TXT" Y DEVUELVE UN ARRAY CON TODOS LOS DATOS
 * @return array
 */
function leeFichero()
{
    $usuarios = array();
    if ($file = fopen("usuarios.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
            $str_arr = explode(",", $line);
            $usuarios[$str_arr[0]] = $str_arr[1];


        }
        fclose($file);
    }
    return $usuarios;
}

