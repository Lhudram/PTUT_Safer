<?php

class Departement
{

    private $numero;
    private $intitule;

    public function __construct(?String $numero, ?String $intitule)
    {
        $this->numero = $numero;
        $this->intitule = $intitule;
    }


    public function getNumero(): ?String
    {
        return $this->numero;
    }

    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }

    public function getIntitule(): ?String
    {
        return $this->intitule;
    }

    public function setIntitule($intitule): void
    {
        $this->intitule = $intitule;
    }
}

?>
