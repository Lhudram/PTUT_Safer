<?php

class Emploi
{
    private $idEmploiCCN;
    private $idIndice;
    private $coefficient;

    public function __construct(?Int $idEmploiCCN, ?String $coefficient)
    {
        $this->idEmploiCCN = empty($idEmploiCCN) ? null : $idEmploiCCN;
        $this->idIndice = $this->getIndiceActuel();
        $this->coefficient = empty($coefficient) ? null : $coefficient;
    }

    //TODO : Implémenter fonction get id indice emploi
    private function getIndiceActuel(): ?Float
    {
        return 1.0;
    }

    public function getIdIndice(): ?Int
    {
        return $this->idIndice;
    }

    public function getIdEmploiCCN(): ?Int
    {
        return $this->idEmploiCCN;
    }

    public function getCoefficient(): ?Int
    {
        return $this->coefficient;
    }


}

?>
