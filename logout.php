<?php
if (isset($_GET['logout'])){
    session_start();
    setcookie('recuerdame',null,time()-1);
    setcookie('vuelve',null,time()-1);
    session_destroy();
    die(header('Location: index.php'));
}
else{ die(header('Location: index.php'));}