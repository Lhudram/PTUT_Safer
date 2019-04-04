<?php

class Indice
{

    private $id;
    private $valeur;

    public function __construct(?Int $id, ?Float $valeur)
    {
        $this->id = $id;
        $this->valeur = $valeur;
    }


    public function getId(): ?Int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getValeur(): ?Float
    {
        return $this->valeur;
    }

    public function setValeur($valeur): void
    {
        $this->valeur = $valeur;
    }
}

?>