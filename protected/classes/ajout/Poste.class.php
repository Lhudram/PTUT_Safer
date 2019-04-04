<?php

class Poste
{
    private $idDepartementPoste;
    private $idCategorie;

    public function __construct(?Int $idDepartement, ?Int $idCategorie)
    {
        $this->idDepartementPoste = empty($idDepartement) ? null : $idDepartement;
        $this->idCategorie = empty($idCategorie) ? null : $idCategorie;
    }

    public function getIdDepartementPoste(): ?Int
    {
        return $this->idDepartementPoste;
    }

    public function getIdCategorie(): ?Int
    {
        return $this->idCategorie;
    }

}

?>
