<?php

class Coordonnees
{
    private $adresse;
    private $complementAdresse;
    private $codePostal;
    private $commune;
    private $codePays;
    private $iban;
    private $bic;

    public function __construct(?String $adresse, ?String $complementAdresse, ?String $codePostal, ?String $commune, ?String $codePays, ?String $iban, ?String $bic)
    {
        $this->adresse = empty($adresse) ? null : $adresse;
        $this->complementAdresse = empty($complementAdresse) ? null : $complementAdresse;
        $this->codePostal = empty($codePostal) ? null : $codePostal;
        $this->commune = empty($commune) ? null : $commune;
        $this->codePays = empty($codePays) ? null : $codePays;
        $this->iban = empty($iban) ? null : $iban;
        $this->bic = empty($bic) ? null : $bic;
    }

    public function getAdresse(): ?String
    {
        return $this->adresse;
    }

    public function getComplementAdresse(): ?String
    {
        return $this->complementAdresse;
    }

    public function getCodePostal(): ?Int
    {
        return $this->codePostal;
    }

    public function getCommune(): ?String
    {
        return $this->commune;
    }

    public function getCodePays(): ?String
    {
        return $this->codePays;
    }

    public function getIban(): ?String
    {
        return $this->iban;
    }

    public function getBic(): ?String
    {
        return $this->bic;
    }
}

?>
