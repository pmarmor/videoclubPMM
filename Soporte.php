<?php
class Soporte
{
    private const IVA=0.21;
    public string $titulo;
    protected int $numero;
    private float $precio;

    /**
     * @param string $titulo
     * @param int $numero
     * @param float $precio
     */
    public function __construct(string $titulo, int $numero, float $precio)
    {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }
    public function getPrecioConIva(){
        return $this->precio+($this->precio*self::IVA);
    }
    public function muestraResumen(){
        echo "Título de la película: ".$this->titulo."<br>Número: ".$this->numero."<br>Precio: ".$this->getPrecioConIva();
}

}
