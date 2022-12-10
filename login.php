<?php
/*CREACIÓN DE VIDEOCLUB*/
include("autoload.php");

use app\Videoclub;

session_start();
if (!isset($_SESSION['videoclub'])){
    $vc = new Videoclub("Severo 8A");
    $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
    $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
    $vc->incluirDvd("Torrente", 4.5, "es", "16:9");
    $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
    $vc->incluirDvd("El Imperio Contraataca", 3, "es,en", "16:9");
    $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
    $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);
    $vc->incluirSocio("Amancio Ortega",null,'0000','AmOr');
    $vc->incluirSocio("Pablo Picasso", 2,'0001','PaPi');
    $vc->alquilaSocioProducto(1, 2);

    $_SESSION['videoclub']=serialize($vc);
}
else{
    $vc=unserialize($_SESSION['videoclub']);
}

//
//EN CASO DE EXISTIR UN USUARIO O CONTRASEÑA, SE REALIZARÁ LA COMPROBACIÓN
if ((isset($_POST["usuario"]) || isset($_POST["contraseña"]))) {

    if (($_POST["usuario"] != null || $_POST["contraseña"] != null)) {
        $usuarioLogin = $_POST['usuario'];
        $contraseñaLogin = $_POST['contraseña'];

        $listaUsuarios=leeFichero();
        foreach($listaUsuarios as $key => $value)
        {
            if ($key!=null){$vc->incluirSocio($key, 3,$value,$key);}

        }
        $_SESSION['videoclub']=serialize($vc);
        $listaUsuarios = $vc->getSocios();
        $existe = false;
        $posicionUsuario=0;
        for ($i = 0; $i < count($listaUsuarios); $i++) {
            if ($listaUsuarios[$i]->getUsuario() == $usuarioLogin) {
                $posicionUsuario=$i;
                $existe = true;
            }
        }
        if ($existe == false) {
            if ($usuarioLogin == "admin" && $contraseñaLogin == "admin") {
                $_SESSION['usuario'] = $usuarioLogin;
                $_SESSION['login'] = true;
                $_SESSION['sesionAdmin'] = true;
                die(include("mainAdmin.php"));
            }
            $error = 'Datos incorrectos';
            session_destroy();
            die(include('index.php'));
        }

        if ($existe) {
            if ($listaUsuarios[$posicionUsuario]->getContraseña()==$contraseñaLogin) {
                $_SESSION['nombre'] = $listaUsuarios[$posicionUsuario]->nombre;
                $_SESSION['usuario'] = $usuarioLogin;
                $_SESSION['contraseña'] = $usuarioLogin;
                $_SESSION['login'] = true;

                die(include('main.php'));
            } else {
                $error = 'Datos incorrectos';
                session_destroy();
                include('index.php');

            }

        } else {
            $error = 'Datos incorrectos';
            session_destroy();
            include('index.php');

        }

    } else {
        die(header('Location: index.php'));
    }


} //SI SE ENTRA DIRECTAMENTE A LOGIN.PHP, SE REDIRECCIONARÁ A INDEX.PHP
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
    if ($file = fopen("credenciales.txt", "r")) {
        while (!feof($file)) {
            $line = fgets($file);
           if ($line!=null){
               $str_arr = explode(",", $line);
               $usuarios[$str_arr[0]] = $str_arr[1];
           }


        }
        fclose($file);
    }
    return $usuarios;
}