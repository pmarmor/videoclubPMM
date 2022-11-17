<?php

class Cliente
{
public string $nombre;
private int $numero;
private array $soportesAlqilados=array();
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
    public function muestraResumen(){
        $this->numSoportesAlquilados=count($this->soportesAlqilados);
        echo ("Nombre: ".$this->nombre."<br>"."Cantidad de alquileres");
    }

}