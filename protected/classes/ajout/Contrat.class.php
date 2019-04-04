<?php

class Contrat
{
    private $idNature;
    private $dateDebut;
    private $finPeriodeEssai;
    private $idTypeEntree;
    private $idEtablissement;

    public function __construct(?Int $idNatureContrat, ?String $dateDebut, ?String $dateFinPeriodeEssai, ?Int $idTypeEntreeContrat, ?Int $idEtablissement)
    {
        $this->idNature = empty($idNatureContrat) ? null : $idNatureContrat;
        $this->dateDebut = empty($dateDebut) ? null : $dateDebut;
        $this->finPeriodeEssai = empty($dateFinPeriodeEssai) ? null : $dateFinPeriodeEssai;
        $this->idTypeEntree = empty($idTypeEntreeContrat) ? null : $idTypeEntreeContrat;
        $this->idEtablissement = empty($idEtablissement) ? null : $idEtablissement;
    }

    public function getIdNature(): ?Int
    {
        return $this->idNature;
    }

    public function getDateDebut(): ?String
    {
        return $this->dateDebut;
    }

    public function getFinPeriodeEssai(): ?String
    {
        return $this->finPeriodeEssai;
    }

    public function getIdTypeEntree(): ?Int
    {
        return $this->idTypeEntree;
    }

    public function getIdEtablissement(): ?Int
    {
        return $this->idEtablissement;
    }

}

?>
