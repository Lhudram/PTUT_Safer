<?php

class EmploiCCN
{
    private $id;
    private $intitule;
    private $categorieSP;
    private $niveau;
    private $mission;

    public function __construct(?Int $id, ?String $intitule, ?Int $idCategorieSP, ?Int $niveau)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->categorieSP = $idCategorieSP;
        $this->niveau = $niveau;
    }

    public function getId(): ?Int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getIntitule(): ?String
    {
        return $this->intitule;
    }

    public function setIntitule($intitule): void
    {
        $this->intitule = $intitule;
    }

    public function getCategorieSP(): ?Int
    {
        return $this->categorieSP;
    }

    public function setCategorieSP($categorieSP): void
    {
        $this->categorieSP = $categorieSP;
    }

    public function getNiveau(): ?Int
    {
        return $this->niveau;
    }

    public function setNiveau($niveau): void
    {
        $this->niveau = $niveau;
    }

    public function setMission($mission): void
    {
        $this->mission = $mission;
    }

    public function getMission(): ?String
    {
        return $this->mission;
    }
}

?>
