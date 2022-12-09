<?php
namespace app;
class Cliente
{
public string $nombre;
private int $numero;
private string $usuario;
private string $contraseña;
private array $soportesAlquilados=array();
private int $numSoportesAlquilados;
private int $maxAlquilerConcurrente;

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @param string $contraseña
     */
    public function setContraseña(string $contraseña): void
    {
        $this->contraseña = $contraseña;
    }

    /**
     * @param array $soportesAlquilados
     */
    public function setSoportesAlquilados(array $soportesAlquilados): void
    {
        $this->soportesAlquilados = $soportesAlquilados;
    }

    /**
     * @param int $maxAlquilerConcurrente
     */
    public function setMaxAlquilerConcurrente(int $maxAlquilerConcurrente): void
    {
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    /**
     * @return string
     */
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * @param string $nombre
     * @param int $numero
     * @param int $maxAlquilerConcurrente
     */
    public function __construct(string $nombre, int $numero, ?int $maxAlquilerConcurrente=3,$usuario,$contraseña)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        if ($maxAlquilerConcurrente!=null){
            $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        }
        else{$this->maxAlquilerConcurrente=3;}
        $this->usuario=$usuario;
        $this->contraseña=$contraseña;
    }

    /**
     * @return string
     */
    public function getContraseña(): string
    {
        return $this->contraseña;
    }

    /**
     * @return array
     */
    public function getSoportesAlquilados(): array
    {
        return $this->soportesAlquilados;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @return int
     */
    public function getNumSoportesAlquilados(): int
    {
        return $this->numSoportesAlquilados;
    }

    /**
     * @param int $numero
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * Muestra el resumen de cliente
     * @return void
     */
    public function muestraResumen(){
        $this->numSoportesAlquilados=count($this->soportesAlquilados);
        echo ("<br>Nombre: ".$this->nombre."<br>Usuario: ".$this->usuario."<br>Contraseña: ".$this->contraseña."<br>Máximo de alquileres permitidos: 
        ".$this->maxAlquilerConcurrente);
        echo $this->listaAlquileres();
        echo "<br>--------------";
    }

    /**
     * Compureba si el soporte introducido está alquilado
     * @param Soporte $s
     * @return bool
     */
    public function tieneAlquilado(Soporte $s): bool{
        $encontrado = false;
        foreach ($this->soportesAlquilados as $soporte) {
            if ($s->getNumero() === $soporte->getNumero()) {
                $encontrado = true;
            }
        }
        return $encontrado;
    }

    /**
     * Método que sirve para alquilar un soporte. Comprueba si se ha superado el cupo y si el soporte ya está alquilado
     * @param Soporte $s
     * @return bool
     * @throws Exception
     */
    public function alquilar(Soporte $s){
        try {
            if (self:: tieneAlquilado($s)){
                echo('<br>El soporte ya está alquilado');
                throw new \Exception("Error: el soporte ya está alquilado");
            }
            elseif(count($this->soportesAlquilados)>=$this->maxAlquilerConcurrente){
                throw new \Exception("Error: cupo de alquiler alcanzado");
                return false;
            }
            else {
                $s->alquilado=true;
                array_push($this->soportesAlquilados, $s);

                echo "<script>console.log("."'"."Soporte con número ".$s->getNumero()." añadido')</script>";
                return true;
            }

        }catch (Exception $exception){
            echo $exception->getMessage();
        }
        }

    public function devolver(int $numSoporte){
        try {
            $nro=0;
            $s=new Dvd("_",$numSoporte,0,"-","-");
            if (self::tieneAlquilado($s)){
                for ($i=0;$i<count($this->soportesAlquilados);$i++){
                    if ($numSoporte==$this->soportesAlquilados[$i]->getNumero()){
                        $nro=$i;
                    }
                }
                $this->soportesAlquilados[$nro]->alquilado=false;
                $nombre=$this->soportesAlquilados[$nro]->getTitulo();
                echo "<script>console.log("."'"."Soporte con número ".$s->getNumero()." devuelto')</script>";
                array_splice(   $this->soportesAlquilados,$nro,1);
                return true;
            }
            else {
                throw new \Exception ("Error: el cliente no tiene el soporte alquilado");
            }
        }catch (Exception $exception){
             $exception->getMessage();
        }
    }
    public function listaAlquileres(): void{
        echo "<br>Soportes alquilados: ".count($this->soportesAlquilados);
        foreach ($this->soportesAlquilados as $soporte) {
         echo "<br>* Título: ".$soporte->titulo.", Número: ".$soporte->getNumero().", Precio: ".$soporte->getPrecio();
        }
    }

}