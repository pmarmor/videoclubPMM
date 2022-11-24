<?php

class Cliente
{
public string $nombre;
private int $numero;
private array $soportesAlquilados=array();
private int $numSoportesAlquilados;
private int $maxAlquilerConcurrente;

    /**
     * @param string $nombre
     * @param int $numero
     * @param int $maxAlquilerConcurrente
     */
    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente=3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
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
        echo ("<br>Nombre: ".$this->nombre."<br>"."Cantidad de alquileres: ".count($this->soportesAlquilados));
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
                return $this;
            }
            elseif(count($this->soportesAlquilados)>=$this->maxAlquilerConcurrente){
                echo('<br>Cupo de alquiler alcanzado');
                return $this;
            }
            else {
                array_push($this->soportesAlquilados, $s);
                echo "<br>Soporte con número ".$s->getNumero()." añadido";
                return $this;
            }

        }catch (Exception $exception){
            echo "Error: no se ha podido alquilar el soporte";
        }
        }

    public function devolver(int $numSoporte): bool{
        $nro=0;
    $s=new Dvd("_",$numSoporte,0,"-","-");
        if (self::tieneAlquilado($s)){
          for ($i=0;$i<count($this->soportesAlquilados);$i++){
            if ($numSoporte==$this->soportesAlquilados[$i]->getNumero()){
                $nro=$i;
            }
          }
         array_splice(   $this->soportesAlquilados,$nro,1);
          echo "<br>"."soporte devuelto";
            return true;
        }
        echo "<br>No tienes alquilado ese soporte";
        return false;
    }
    public function listaAlquileres(): void{
        echo "<br>Soportes alquilados: ".count($this->soportesAlquilados);
        foreach ($this->soportesAlquilados as $soporte) {
         echo "<br>* Título: ".$soporte->titulo.", Número: ".$soporte->getNumero().", Precio: ".$soporte->getPrecio();
        }
    }

}