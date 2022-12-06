<?php
namespace app ;
include ("..\autoload.php");
use app\Soporte;
use app\Juego;
use app\CintaVideo;
use app\Cliente;
class Videoclub
{
private string $nombre;
private array $productos=array();
private int $numProductos=-1;
private array $socios=array();
private int $numsocios=-1;
private int $numProductosAlquilados=0;
private int $numTotalAlquileres=0;

public function setNumProductosAlquilados(){
    foreach ($this->productos as $soporte) {
       if ($soporte->alquilado==true){
           $this->numProductosAlquilados=$this->numProductosAlquilados+1;
       }
    }
}

    /**
     * @return int
     */
    public function getNumProductosAlquilados(): int
    {
        $this->setNumProductosAlquilados();
        return $this->numProductosAlquilados;
    }

    /**
     * @return int
     */
    public function getNumTotalAlquileres(): int
    {
        return $this->numTotalAlquileres;
    }

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
public function devolverSocioProducto(int $numSocio, int $numeroProducto){
    try {
        if ($numeroProducto>count($this->productos)){
            throw new \Exception("No se ha encontrado el soporte");
        }
        if ($numeroProducto>count($this->productos)){
            throw new \Exception("No se ha podido alguilar el soporte");
        }
        $this->socios[$numSocio]->devolver($numeroProducto);
    }catch (Exception $exception){
        echo $exception->getMessage();
    }
}
    public function devolverSocioProductos(int $numSocio, array $numeroProductos){
        foreach ($numeroProductos as $nro) {
            try {
                if ($nro>count($this->productos)){
                    throw new \Exception("No se ha encontrado el soporte");
                }
                if ($nro>count($this->productos)){
                    throw new \Exception("No se ha podido alguilar el soporte");
                }
                $this->socios[$numSocio]->devolver($nro);
            }catch (Exception $exception){
                echo $exception->getMessage();
            }
        }
    }
    public function alquilaSocioProducto(int $nroCliente, int $nroSoporte){
        try {
            if ($nroSoporte>count($this->productos)){
                throw new \Exception("No se ha encontrado el soporte");
            }
            if ($nroSoporte>count($this->productos)){
                throw new \Exception("No se ha podido alguilar el soporte");
            }
            $soporte=$this->productos[$nroSoporte];
            $this->socios[$nroCliente]->alquilar($soporte);
            return $this;
        }catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
    public function alquilarSocioProductos(int $numSocio, array $numerosProductos){
        foreach ($numerosProductos as $nroSoporte) {
            try {
                if ($numSocio>count($this->productos)){
                    throw new \Exception("No se ha encontrado el soporte");
                }
                if ($this->numsocios>count($this->productos)){
                    throw new \Exception("No se ha podido alguilar el soporte");
                }
                $soporte=$this->productos[$nroSoporte];
                $this->socios[$numSocio]->alquilar($soporte);

            }catch (Exception $exception){
                echo $exception->getMessage();
            }
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