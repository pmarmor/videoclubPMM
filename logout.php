<?php
if (isset($_POST['logout'])){
    session_start();
    setcookie('recuerdame',null,time()-1);
    setcookie('vuelve',null,time()-1);
    $_SESSION['login']=false;
    if (isset($_SESSION['sesionAdmin'])){
        if($_SESSION['sesionAdmin']==true){
            $_SESSION['sesionAdmin']==false;
        }
    }
    die(header('Location: index.php'));
}
else{ die(header('Location: index.php'));}