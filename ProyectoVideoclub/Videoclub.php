<?php
namespace ProyectoVideoclub;
include("Soporte.php");
include("Juego.php");
include("CintaVideo.php");
include("Cliente.php");

use ProyectoVideoclub\Soporte;
use ProyectoVideoclub\Juego;
use ProyectoVideoclub\CintaVideo;
use ProyectoVideoclub\Cliente;
class Videoclub
{
private string $nombre;
private array $productos=array();
private int $numProductos=0;
private array $socios=array();
private int $numsocios=0;

    /**
     * @param string $nombre
     */
    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }
    public function listarProductos(){
        echo "LISTA DE PRODUCTOS<br>";
        foreach ($this->productos as $soporte) {
            $soporte->muestraResumen();
            echo "<br>";
        }
        echo "<br>FIN DE LA LISTA<br>";
    }
    public function listarSocios(){
        echo "<br>LISTA DE SOCIOS<br>";
        foreach ($this->socios as $socio) {
            $socio->muestraResumen();
            echo "<br>";
        }
        echo "<br>FIN DE LA LISTA<br>";
    }
    public function alquilaSocioProducto(int $nroCliente, int $nroSoporte){
        try {
            $soporte=$this->productos[$nroSoporte];
            $this->socios[$nroCliente]->alquilar($soporte);
            return $this;
        }catch (Exception $exception){
            echo "No se ha podido alquilar soporte";
        }
    }
    private function incluirProducto( Soporte $soporte){
       array_push( $this->productos,$soporte);
    }
    public function incluirJuego(string $titulo, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores){
        $this->numProductos=$this->numProductos+1;
        $juego=new Juego($titulo,$this->numProductos,$precio,$consola,$minNumJugadores,$maxNumJugadores);
        $this->incluirProducto($juego);

    }
    public function incluirCintaVideo(string $titulo, float $precio, string $duracion){
        $this->numProductos=$this->numProductos+1;
        $cinta=new CintaVideo($titulo,$this->numProductos,$precio,$duracion);
        $this->incluirProducto($cinta);

    }
    public function incluirDvd(string $titulo,float $precio, string $idioma, string $formatPantalla){
        $this->numProductos=$this->numProductos+1;
        $dvd=new CintaVideo($titulo,$this->numProductos,$precio,$idioma,$formatPantalla);
        $this->incluirProducto($dvd);

    }
    public function incluirSocio(string $nombre, int $maxAlqilerConcurrente=3){
        $this->numsocios=$this->numsocios+1;
        $socio=new Cliente($nombre,$this->numsocios,$maxAlqilerConcurrente);
        array_push($this->socios,$socio);
    }
}